<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user_id'])) {
    return [];
}

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT
        l.id AS listing_id,
        l.isbn,
        l.price,
        l.currency,
        l.status,
        li.image_path
    FROM listings l
    LEFT JOIN listings_images li ON li.listing_id = l.id
    WHERE l.user_id = ?
    ORDER BY l.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$listings = [];

while ($row = $result->fetch_assoc()) {
    $id = $row['listing_id'];

    if (!isset($listings[$id])) {
        $listings[$id] = [
            'isbn' => $row['isbn'],
            'price' => $row['price'],
            'currency' => $row['currency'],
            'status' => $row['status'],
            'images' => []
        ];
    }

    if (!empty($row['image_path'])) {
        $listings[$id]['images'][] = $row['image_path'];
    }
}

$stmt->close();

return $listings;