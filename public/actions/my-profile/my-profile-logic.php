<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /sagaswap/public/pages/login.php");
    exit;
}

// get listings array
$listings = require __DIR__ . '/user-listings.php';

// db connection
$mysqli = new mysqli("localhost", "root", "", "sagaswap");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// fetch category from db
$categories = [];
$sql = "SELECT id, name FROM categories ORDER BY name ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// prepare and execute query for multiple columns
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("
    SELECT u.username, u.email, u.created_at, u.id, m.name AS municipality_name
    FROM users u
    LEFT JOIN municipalities m ON u.municipality_id = m.id
    LEFT JOIN listings l ON u.id = l.user_id
    WHERE u.id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $created_at, $id, $municipality_name);
$stmt->fetch();
$stmt->close();
$mysqli->close();