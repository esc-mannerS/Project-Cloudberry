<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /sagaswap/public/pages/login.php");
    exit;
}

if (!isset($_POST['listing_id'])) {
    header("Location: /sagaswap/public/pages/my-profile.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$listing_id = (int)$_POST['listing_id'];

// db connection
$mysqli = new mysqli("localhost", "root", "", "sagaswap");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// delete only if listing belongs to user
$stmt = $mysqli->prepare("
    DELETE FROM listings 
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $listing_id, $user_id);
$stmt->execute();

$stmt->close();
$mysqli->close();

// redirect to profile
header("Location: /sagaswap/public/pages/my-profile.php");
exit;