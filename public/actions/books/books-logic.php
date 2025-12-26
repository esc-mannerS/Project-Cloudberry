<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config.php';

$sql = "
    SELECT
        b.isbn,
        b.title,
        COUNT(l.id)  AS total_listings,
        AVG(l.price) AS avg_price
    FROM books b
    INNER JOIN listings l ON l.isbn = b.isbn
    GROUP BY b.isbn, b.title
    ORDER BY MAX(l.created_at) DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$books = [];

while ($row = $result->fetch_assoc()) {
    // formatting for avg price
    $row['avg_price'] = number_format((float)$row['avg_price'], 2, ',', '.');
    $books[] = $row;
}

$stmt->close();