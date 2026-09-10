<?php
/**
 * HXH-C8 Router & Security Guard for PHP Built-in Server
 * Enforces 403 Forbidden on all sensitive files, DB dumps, and solution writeups
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// 1. Forbidden extensions & sensitive files
$forbiddenPatterns = [
    '/\.(sql|md|sqlite|db|json|yml|yaml|env|bak|sh|log|ini|lock|dist|swp)$/i',
    '/(\/|^)(Dockerfile|docker-compose\.yml|start\.sh|router\.php)$/i',
    '/(\/|^)(config\.php|db\.php)$/i',
    '/\/data(\/|$)/i',
    '/\/solution(\/|$)/i',
    '/\/includes(\/|$)/i',
    '/\/\./'
];

foreach ($forbiddenPatterns as $pattern) {
    if (preg_match($pattern, $uri)) {
        http_response_code(403);
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body style="background:#07090e;color:#ff4d4d;font-family:sans-serif;padding:40px;text-align:center;">' .
             '<h1>⚔️ 403 FORBIDDEN</h1>' .
             '<p style="color:#cbd5e1;">Hunter Association Security Barrier: Direct access to classified system files is strictly prohibited.</p>' .
             '</body></html>';
        exit;
    }
}

// 2. Subdomain check
$host = strtolower($_SERVER['HTTP_HOST'] ?? '');
$parts = explode('.', $host);
if (count($parts) > 1) {
    $subdomain = strtolower($parts[0]);
    $chatbotSubdomains = ['chat', 'chatbot', 'ai', 'assistant', 'support', 'bot', 'terminal', 'helpdesk'];
    if (in_array($subdomain, $chatbotSubdomains)) {
        require_once __DIR__ . '/chatbot.php';
        exit;
    }
}

// 3. Serve standard PHP / static files
if ($uri !== '/' && file_exists($file)) {
    if (is_dir($file)) {
        if (file_exists($file . '/index.php')) {
            require $file . '/index.php';
            exit;
        }
        http_response_code(403);
        exit('<h1>403 Forbidden</h1><p>Directory listing denied.</p>');
    }
    return false; // Let PHP built-in server handle standard static assets
}

// Default to index.php
require_once __DIR__ . '/index.php';
