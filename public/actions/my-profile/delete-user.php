<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /sagaswap/public/pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// db connection
$mysqli = new mysqli("localhost", "root", "", "sagaswap");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// delete the user account
$stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// log user out
session_destroy();

// Redirect to goodbye page
header("Location: /sagaswap/public/pages/account-deleted.php");
exit;
?>