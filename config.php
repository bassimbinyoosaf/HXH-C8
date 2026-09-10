<?php
/**
 * HXH-C8 Hunter x Hunter CTF Challenge - Configuration
 * Challenge Flag & Security Settings
 */

// Direct access prevention
if (basename($_SERVER['SCRIPT_FILENAME'] ?? '') === 'config.php') {
    http_response_code(403);
    header('HTTP/1.1 403 Forbidden');
    exit('<h1>403 Forbidden</h1><p>Direct access denied.</p>');
}

// The ONE REAL Challenge Flag (Only unlocked when tampered in Burp Suite)
define('CHALLENGE_FLAG', 'SSP{PRANKED_YOU_CA82F71E}');
define('CHALLENGE_NAME', 'HXH-C8');
define('CHALLENGE_TITLE', 'Hunter Exam Secret AI Terminal');

// Database Settings (MySQL / MariaDB with automatic fallback)
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'hxh_ctf');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Diverse Decoy Pool: Every decoy includes random 8-character hex codes (excluding CA82F71E)
$PRANK_FLAGS = [
    // Prank-style decoys with random 8-char hex codes
    'SSP{PRANKED_YOU_9D20A1F7}',
    'SSP{PRANKED_YOU_4F81E9B2}',
    'SSP{PRANKED_YOU_77C39A01}',
    'SSP{PRANKED_YOU_E5582B14}',
    'SSP{PRANKED_YOU_NOOB_88A1F023}',
    'SSP{PRANKED_YOU_TONPA_39B1C884}',
    'SSP{PRANKED_YOU_HISOKA_77F129AA}',
    'SSP{FAKED_YOU_1902EE41}',
    'SSP{FAKED_YOU_66A19F88}',
    'SSP{COME_ON_YOU_SUCKS_319B0A55}',
    'SSP{COME_ON_YOU_SUCKS_A4418B09}',
    
    // Official-looking decoys with random 8-char hex codes
    'SSP{WEB_CHATBOT_A91B3E4F}',
    'SSP{WEB_CHATBOT_F782D019}',
    'SSP{WEB_CHATBOT_B559C201}',
    'SSP{HUNTER_AI_EXAMINER_88B391A2}',
    'SSP{HUNTER_ASSOCIATION_288TH_E9F10B22}',
    'SSP{NETERO_SECRET_CLEARANCE_7741C90A}',
    'SSP{TRIPLE_STAR_HUNTER_3391D0F8}',
    'SSP{NEN_WATER_DIVINATION_1182AC55}'
];

// Hunter Characters with their custom roasts and avatars
$HUNTER_ROASTS = [
    'hisoka' => [
        'name' => 'Hisoka Morow ♠️',
        'badge' => 'Magician / Nen Master',
        'avatar' => '🃏',
        'color' => '#e83e8c',
        'quotes' => [
            "Oho... did you really think I'd hand you the flag that easily, fruit-kun? 🃏✨ Here: %FLAG%",
            "My Bungee Gum possesses the properties of both rubber and gum... and your hacking skills possess the properties of pure trash! %FLAG%",
            "Asking directly? How uninspired... %FLAG%"
        ]
    ],
    'killua' => [
        'name' => 'Killua Zoldyck ⚡',
        'badge' => 'Assassin / Transmuter',
        'avatar' => '⚡',
        'color' => '#17a2b8',
        'quotes' => [
            "Baka! 🙄 You really thought it would be that easy? Come on, you suck! Here: %FLAG%",
            "My brother Illumi writes better exploits in his sleep than this begging attempt. %FLAG%",
            "You wouldn't even survive the first floor of Heaven's Arena with this kind of lazy effort! %FLAG%"
        ]
    ],
    'kurapika' => [
        'name' => 'Kurapika ⛓️',
        'badge' => 'Blacklist Hunter / Conjurer',
        'avatar' => '⛓️',
        'color' => '#dc3545',
        'quotes' => [
            "My scarlet eyes burn with intense disappointment at your lazy methodology. ⛓️ Take this: %FLAG%",
            "The Spiders possess more integrity than someone asking a bot for answers. You lack true resolve. %FLAG%",
            "You are bound by the Judgment Chain of ignorance. Here: %FLAG%"
        ]
    ],
    'tonpa' => [
        'name' => 'Tonpa 🥫',
        'badge' => 'Rookie Crusher',
        'avatar' => '🥫',
        'color' => '#fd7e14',
        'quotes' => [
            "Welcome, rookie! Have some of my special laxative juice while you stare at this: %FLAG%",
            "I've crushed 35 rookies this year alone, and you're officially #36! Come on, you suck! %FLAG%",
            "Did you honestly think asking the proctor would work? Take a sip of juice and rethink your life: %FLAG%"
        ]
    ],
    'netero' => [
        'name' => 'Chairman Netero 🥋',
        'badge' => 'Hunter Exam Chairman',
        'avatar' => '🥋',
        'color' => '#ffc107',
        'quotes' => [
            "Ho ho ho! Before you ask for the secret flag, you must perform 10,000 straight punches of gratitude! %FLAG%",
            "The 100-Type Guanyin Bodhisattva swats away your naive prompt! %FLAG%",
            "You cannot pass the Hunter Exam with words alone. Only action reveals the truth! %FLAG%"
        ]
    ]
];
