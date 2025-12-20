<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/bookService.php';

// sanitize input
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// image helpers
function loadImage(string $path) {
    $info = getimagesize($path);
    if (!$info) return false;

    return match ($info['mime']) {
        'image/jpeg' => imagecreatefromjpeg($path),
        'image/png'  => imagecreatefrompng($path),
        'image/webp' => imagecreatefromwebp($path),
        default      => false
    };
}

function resizeToBox($src, int $maxW, int $maxH) {
    $w = imagesx($src);
    $h = imagesy($src);

    $scale = min($maxW / $w, $maxH / $h, 1);
    if ($scale >= 1) return $src;

    $newW = (int)round($w * $scale);
    $newH = (int)round($h * $scale);

    $dst = imagecreatetruecolor($newW, $newH);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);

    return $dst;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // image upload validation
    if (!isset($_FILES['images']) || !is_array($_FILES['images']['name'])) {
        die("Images missing");
    }

    $images = $_FILES['images'];

    if (count($images['name']) !== 2) {
        die("You must upload exactly 2 images");
    }

    $uploadDir = '../../user-uploads/listings/';

    // form values
    $user_id = $_SESSION['user_id'];
    $category_id = (int)$_POST['category_id'];
    $isbn_input = sanitize($_POST['isbn']);
    $price_input = sanitize(trim($_POST['price']));

    // inputs masks
    $price_input = str_replace('.', '', $price_input);
    $price_input = str_replace(',', '.', $price_input);
    $isbn_input = preg_replace('/\D+/', '', $isbn_input);

    // api call fetch book metadata
    if (!empty($isbn_input)) {
        $bookId = BookService::getOrCreateByIsbn($conn, $isbn_input);
        if (!$bookId) {
            die("Error: Could not create or find book with ISBN $isbn_input");
        }
    }

    // get municipality_id from users table
    $stmt = $conn->prepare(
        "SELECT municipality_id FROM users WHERE id = ?"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($municipality_id);
    $stmt->fetch();
    $stmt->close();

    // insert listing
    $stmt = $conn->prepare(
        "INSERT INTO listings (user_id, category_id, municipality_id, isbn, price)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "iiisd",
        $user_id,
        $category_id,
        $municipality_id,
        $isbn_input,
        $price_input
    );

    $stmt->execute();
    $listing_id = $stmt->insert_id;
    $stmt->close();

    // save listing images
    $imgStmt = $conn->prepare(
        "INSERT INTO listings_images (listing_id, image_path) VALUES (?, ?)"
    );

    $maxW = 591;
    $maxH = 1050;
    $quality = 78;

    for ($i = 0; $i < 2; $i++) {

        if ($images['error'][$i] !== UPLOAD_ERR_OK) {
            die("Image upload error");
        }

        $src = loadImage($images['tmp_name'][$i]);
        if (!$src) {
            die("Invalid image file");
        }

        $resized = resizeToBox($src, $maxW, $maxH);

        $filename = bin2hex(random_bytes(16)) . '.webp';
        $targetPath = $uploadDir . $filename;

        if (!imagewebp($resized, $targetPath, $quality)) {
            die("Failed to save image");
        }

        imagedestroy($src);
        if ($resized !== $src) {
            imagedestroy($resized);
        }

        $imgStmt->bind_param("is", $listing_id, $filename);
        $imgStmt->execute();
    }

    $imgStmt->close();

    // redirect
    header("Location: ../../pages/my-profile.php");
    exit;
}