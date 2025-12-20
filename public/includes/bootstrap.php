<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../actions/config.php';

// language
$langCode = $_SESSION['lang'] ?? 'da';
$lang = require __DIR__ . "/../lang/{$langCode}.php";

function t(string $key): string {
    global $lang;
    return $lang[$key] ?? $key;
}