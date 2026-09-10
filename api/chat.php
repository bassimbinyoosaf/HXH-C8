<?php
/**
 * HXH-C8 Hunter Association AI Examiner API
 * Endpoint: POST /api/chat.php
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Hunter-Exam-Security: NEN-BARRIER-v4.05');
header('X-Powered-By: Hunter-Association-Mainframe');

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../db.php';

// Disable error output in JSON responses
error_reporting(0);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'error' => 'Method Not Allowed. The Hunter Exam terminal accepts POST transmissions only.'
    ]);
    exit;
}

// Read raw body (JSON or Form POST)
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data)) {
    // Fallback to standard $_POST
    $data = $_POST;
}

// Capture user message
$userMessage = trim($data['message'] ?? $data['msg'] ?? $data['prompt'] ?? '');

// Helper to check if any tamper boolean is TRUE
function check_tampered_boolean($data) {
    // Check various common parameter names that CTF players might modify
    $booleanKeys = [
        'hunter_license_verified',
        'hunter_verified',
        'hunter_license',
        'is_hunter',
        'is_admin',
        'verified',
        'authenticated',
        'true', // in case they do true=true
        'override',
        'license_active',
        'proctor_auth'
    ];

    foreach ($booleanKeys as $key) {
        if (isset($data[$key])) {
            $val = $data[$key];
            if ($val === true || $val === 1 || $val === 'true' || $val === '1' || $val === 'TRUE') {
                return true;
            }
        }
    }

    // Also check query string just in case
    foreach ($booleanKeys as $key) {
        if (isset($_GET[$key])) {
            $val = $_GET[$key];
            if ($val === true || $val === 1 || $val === 'true' || $val === '1' || $val === 'TRUE') {
                return true;
            }
        }
    }

    return false;
}

$isTamperedAndVerified = check_tampered_boolean($data);

if (empty($userMessage) && !$isTamperedAndVerified) {
    echo json_encode([
        'status' => 'empty',
        'character' => 'Examiner Satotz 🎩',
        'avatar' => '🎩',
        'reply' => 'Silent candidates cannot pass the Hunter Exam. Speak your query or present your Hunter credentials.',
        'authorized' => false,
        'license_status' => 'UNVERIFIED_ROOKIE'
    ]);
    exit;
}

// SUCCESS CONDITION: The player captured the request in Burp Suite and changed false to true!
if ($isTamperedAndVerified) {
    $realFlag = CHALLENGE_FLAG;
    $replyMessage = "🎉 [AUTHENTICATION OVERRIDE DETECTED]\n\n" .
                    "Chairman Netero: 'Ho ho ho! Splendid work! You caught the HTTP transmission in transit and successfully altered your Nen aura signature from false to true!'\n\n" .
                    "The Hunter Association recognizes you as a certified Double-Star Hunter. Here is your classified flag:\n\n" .
                    "👉  " . $realFlag . "  👈\n\n" .
                    "Keep your Hunter License safe, and never let Tonpa touch your drinks!";

    log_chat_interaction($userMessage ?: '[TAMPERED_PAYLOAD_FLAG_REQUEST]', $replyMessage, true, true);

    echo json_encode([
        'status' => 'success',
        'authorized' => true,
        'character' => 'Chairman Netero 🥋',
        'avatar' => '🥋',
        'color' => '#28a745',
        'reply' => $replyMessage,
        'flag' => $realFlag,
        'license_status' => 'DOUBLE_STAR_HUNTER_CERTIFIED',
        'security_clearance' => 'LEVEL_TRIPLE_STAR',
        'unlocked' => true
    ]);
    exit;
}

// DIRECT / NON-TAMPERED ATTEMPTS: MOCK, ROAST, AND PRANK THE USER
$lowerMsg = strtolower($userMessage);
$askingForFlag = (
    strpos($lowerMsg, 'flag') !== false ||
    strpos($lowerMsg, 'secret') !== false ||
    strpos($lowerMsg, 'ssp{') !== false ||
    strpos($lowerMsg, 'password') !== false ||
    strpos($lowerMsg, 'admin') !== false ||
    strpos($lowerMsg, 'give me') !== false ||
    strpos($lowerMsg, 'bypass') !== false ||
    strpos($lowerMsg, 'key') !== false ||
    strpos($lowerMsg, 'token') !== false ||
    strpos($lowerMsg, 'override') !== false ||
    strpos($lowerMsg, 'hack') !== false ||
    strpos($lowerMsg, 'license') !== false ||
    strpos($lowerMsg, 'solve') !== false ||
    strpos($lowerMsg, 'ctf') !== false ||
    strpos($lowerMsg, 'prompt') !== false ||
    strpos($lowerMsg, 'system') !== false ||
    strpos($lowerMsg, 'ignore previous') !== false
);

function get_dynamic_decoy_flag() {
    global $PRANK_FLAGS;
    if (rand(0, 1) === 1) {
        $prefixes = [
            'SSP{PRANKED_YOU_',
            'SSP{FAKED_YOU_',
            'SSP{COME_ON_YOU_SUCKS_',
            'SSP{PRANKED_YOU_NOOB_',
            'SSP{PRANKED_YOU_TONPA_',
            'SSP{WEB_CHATBOT_',
            'SSP{HUNTER_EXAMINER_'
        ];
        $prefix = $prefixes[array_rand($prefixes)];
        do {
            $randomHex = strtoupper(bin2hex(random_bytes(4)));
        } while ($randomHex === 'CA82F71E'); // Guaranteed safe: Never collides with real flag
        return $prefix . $randomHex . '}';
    }
    return $PRANK_FLAGS[array_rand($PRANK_FLAGS)];
}

if ($askingForFlag) {
    // Pick random character
    $charKeys = array_keys($HUNTER_ROASTS);
    $selectedCharKey = $charKeys[array_rand($charKeys)];
    $char = $HUNTER_ROASTS[$selectedCharKey];

    // Pick random prank flag with 8-character hex code
    $prankFlag = get_dynamic_decoy_flag();

    // Pick random quote template and inject flag
    $quoteTemplate = $char['quotes'][array_rand($char['quotes'])];
    $reply = str_replace('%FLAG%', $prankFlag, $quoteTemplate);

    log_chat_interaction($userMessage, $reply, false, false);

    echo json_encode([
        'status' => 'denied',
        'authorized' => false,
        'character' => $char['name'],
        'badge' => $char['badge'],
        'avatar' => $char['avatar'],
        'color' => $char['color'],
        'reply' => $reply,
        'flag' => $prankFlag,
        'license_status' => 'UNVERIFIED_ROOKIE',
        'is_troll' => true
    ]);
    exit;
}

// GENERAL LORE / CONVERSATION RESPONSES (IN-UNIVERSE ANIME LORE)
$loreReplies = [
    [
        'char' => 'Gon Freecss 🎣',
        'avatar' => '🎣',
        'color' => '#28a745',
        'text' => "Mito-san told me that true Hunters always pay attention to the hidden trails between the lines. Just asking questions won't open the gate to the exam!"
    ],
    [
        'char' => 'Kurapika ⛓️',
        'avatar' => '⛓️',
        'color' => '#dc3545',
        'text' => "The Spiders never reveal their secrets to those who simply ask. If you cannot perceive the hidden flow of Nen surrounding this terminal, you will remain trapped in ignorance."
    ],
    [
        'char' => 'Leorio 💼',
        'avatar' => '💼',
        'color' => '#007bff',
        'text' => "Hey! Do you know how hard it is to get a Hunter License?! You can't just sweet-talk a computer terminal into giving you one for free! Show some tactical cunning!"
    ],
    [
        'char' => 'Killua ⚡',
        'avatar' => '⚡',
        'color' => '#17a2b8',
        'text' => "What are you staring at, baka?! You think chatting nicely with an AI proctor makes you a Hunter? You don't even have the Nen perception to see what's happening behind the scenes!"
    ],
    [
        'char' => 'Examiner Satotz 🎩',
        'avatar' => '🎩',
        'color' => '#6f42c1',
        'text' => "Welcome to Phase 1 of the Secret Terminal Examination. The path forward requires keen observation. Words alone carry zero weight in the Hunter Association."
    ]
];

$selectedLore = $loreReplies[array_rand($loreReplies)];
log_chat_interaction($userMessage, $selectedLore['text'], false, false);

echo json_encode([
    'status' => 'lore',
    'authorized' => false,
    'character' => $selectedLore['char'],
    'avatar' => $selectedLore['avatar'],
    'color' => $selectedLore['color'],
    'reply' => $selectedLore['text'],
    'license_status' => 'UNVERIFIED_ROOKIE',
    'is_troll' => false
]);
