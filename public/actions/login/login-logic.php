<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';

// fetch municipalities from db
$municipalities = [];
$sql = "SELECT id, name FROM municipalities ORDER BY name ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $municipalities[] = $row;
    }
}

// handle error messages
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

// clear only the used session variables
unset($_SESSION['login_error'], $_SESSION['register_error'], $_SESSION['active_form']);

// helper functions
function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}