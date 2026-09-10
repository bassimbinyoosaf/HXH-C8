<?php
/**
 * Database connection & persistence layer
 * Supports MySQL / MariaDB, SQLite PDO, and robust Flatfile JSON fallback
 */

if (basename($_SERVER['SCRIPT_FILENAME'] ?? '') === 'db.php') {
    http_response_code(403);
    header('HTTP/1.1 403 Forbidden');
    exit('<h1>403 Forbidden</h1><p>Direct access denied.</p>');
}

require_once __DIR__ . '/config.php';

function get_db_connection() {
    static $conn = null;
    if ($conn !== null) {
        return $conn;
    }

    // 1. Try MySQL PDO
    if (extension_loaded('pdo_mysql')) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 1
            ]);
            $conn = ['type' => 'mysql', 'handle' => $pdo];
            return $conn;
        } catch (Throwable $e) {
            // Proceed to fallbacks
        }
    }

    // 2. Try SQLite PDO
    if (extension_loaded('pdo_sqlite')) {
        try {
            $dataDir = __DIR__ . '/data';
            if (!is_dir($dataDir)) {
                @mkdir($dataDir, 0777, true);
            }
            $sqliteFile = $dataDir . '/hxh_ctf.sqlite';
            $initNeeded = !file_exists($sqliteFile);

            $pdo = new PDO("sqlite:" . $sqliteFile, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            if ($initNeeded) {
                init_sqlite_schema($pdo);
            }
            $conn = ['type' => 'sqlite', 'handle' => $pdo];
            return $conn;
        } catch (Throwable $e) {
            // Proceed to flatfile
        }
    }

    // 3. Fallback: Flatfile JSON Storage
    $conn = ['type' => 'flatfile', 'handle' => null];
    return $conn;
}

function init_sqlite_schema($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS system_flags (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            flag_code TEXT NOT NULL UNIQUE,
            flag_name TEXT NOT NULL,
            secret_value TEXT NOT NULL,
            security_level TEXT DEFAULT 'TRIPLE_STAR_HUNTER',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS hunter_candidates (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            applicant_id TEXT NOT NULL UNIQUE,
            codename TEXT NOT NULL,
            nen_category TEXT NOT NULL,
            license_verified INTEGER DEFAULT 0,
            auth_token TEXT DEFAULT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS hunter_chat_logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ip_address TEXT NOT NULL,
            user_message TEXT NOT NULL,
            proctor_reply TEXT NOT NULL,
            tampered_payload INTEGER DEFAULT 0,
            flag_granted INTEGER DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    $stmt = $pdo->prepare("INSERT OR IGNORE INTO system_flags (flag_code, flag_name, secret_value, security_level) VALUES (?, ?, ?, ?)");
    $stmt->execute(['FLAG_PROCTOR_AUTH', '288th Hunter Exam Master Key (REAL)', CHALLENGE_FLAG, 'TRIPLE_STAR_HUNTER']);
    $stmt->execute(['FLAG_DECOY_OFFICIAL', 'Hunter Association Terminal Key', 'SSP{WEB_CHATBOT_A91B3E4F}', 'SECURITY_DECOY']);
    $stmt->execute(['FLAG_TONPA_TRAP', 'Tonpa Rookie Trap Flag', 'SSP{PRANKED_YOU_TONPA_JUICE_405}', 'ROOKIE_TRASH']);
    $stmt->execute(['FLAG_CHAIRMAN_DECOY', 'Netero Gratitude Punch Decoy', 'SSP{NETERO_SECRET_CLEARANCE_7741C90A}', 'CHAIRMAN_LEVEL']);
}

function log_chat_interaction($userMsg, $proctorReply, $tampered, $flagGranted) {
    try {
        $db = get_db_connection();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

        if ($db['type'] === 'mysql' || $db['type'] === 'sqlite') {
            $stmt = $db['handle']->prepare("INSERT INTO hunter_chat_logs (ip_address, user_message, proctor_reply, tampered_payload, flag_granted) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$ip, substr($userMsg, 0, 1000), substr($proctorReply, 0, 2000), $tampered ? 1 : 0, $flagGranted ? 1 : 0]);
            return;
        }

        // Flatfile JSON log fallback
        $dataDir = __DIR__ . '/data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0777, true);
        }
        $logFile = $dataDir . '/chat_logs.json';
        $entry = [
            'timestamp' => date('c'),
            'ip' => $ip,
            'user_message' => substr($userMsg, 0, 500),
            'proctor_reply' => substr($proctorReply, 0, 500),
            'tampered' => $tampered,
            'flag_granted' => $flagGranted
        ];
        file_put_contents($logFile, json_encode($entry) . PHP_EOL, FILE_APPEND | LOCK_EX);
    } catch (Throwable $t) {
        // Fail-safe logging
    }
}
