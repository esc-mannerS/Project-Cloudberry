<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config.php';

if (!isset($_GET['isbn'])) {
    http_response_code(400);
    exit('ISBN mangler');
}

$isbn = $_GET['isbn'];

// fetch book info
$sql = "SELECT title FROM books WHERE isbn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $isbn);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$book) {
    http_response_code(404);
    exit('Bog ikke fundet');
}

$sql = "
    SELECT
        l.id AS listing_id,
        l.price,
        l.created_at,
        li.image_path
    FROM listings l
    LEFT JOIN listings_images li ON li.listing_id = l.id
    WHERE isbn = ?
    ORDER BY created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $isbn);
$stmt->execute();
$result = $stmt->get_result();

$listings = [];

while ($row = $result->fetch_assoc()) {
    $id = $row['listing_id'];
    
    if (!isset($listings[$id])) {
        $listings[$id] = [
            'price' => $row['price'],
            'created_at' => $row['created_at'],
            'images' => []
        ];
    }

    if (!empty($row['image_path'])) {
        $listings[$id]['images'][] = $row['image_path'];
    }
}

$stmt->close();