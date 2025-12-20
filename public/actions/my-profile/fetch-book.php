<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/bookService.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$isbn = preg_replace('/\D+/', '', $data['isbn'] ?? '');

if (!$isbn || (strlen($isbn) !== 10 && strlen($isbn) !== 13)) {
    echo json_encode(['success' => false, 'error' => 'invalid_isbn']);
    exit;
}

$bookId = BookService::getOrCreateByIsbn($conn, $isbn);

if (!$bookId) {
    echo json_encode(['success' => false, 'error' => 'not_found']);
    exit;
}

// fetch book data for autofill
$stmt = $conn->prepare("
    SELECT title, author
    FROM books
    WHERE id = ?
");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$stmt->bind_result($title, $author);
$stmt->fetch();
$stmt->close();

echo json_encode([
    'success' => true,
    'book_id' => $bookId,
    'title'   => $title,
    'author'  => $author
]);