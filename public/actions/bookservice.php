<?php
require_once __DIR__ . '/api_config.php';

class BookService {

    public static function getOrCreateByIsbn(mysqli $conn, string $isbn): ?int {
        // 1 check db first
        $stmt = $conn->prepare("SELECT id FROM books WHERE isbn = ?");
        $stmt->bind_param("s", $isbn);
        $stmt->execute();
        $stmt->bind_result($bookId);
        if ($stmt->fetch()) {
            $stmt->close();
            return $bookId;
        }
        $stmt->close();

        // 2 fetch Open Library
        $bookData = self::fetchFromOpenLibrary($isbn);

        // 3 if OL returns nothing, call google as full fallback
        if (empty($bookData['title'])) {
            $bookData = self::fetchFromGoogleFull($isbn) ?? [];
        } else {
            // 4 OL returned partial data, google only fills missing fields
            $googleData = self::fetchFromGoogleFull($isbn);
            if ($googleData) {
                $bookData['author']    = $bookData['author'] ?? $googleData['author'];
                $bookData['publisher'] = $bookData['publisher'] ?? $googleData['publisher'];
                $bookData['genre']     = $bookData['genre'] ?? $googleData['genre'];
                $bookData['year']      = $bookData['year'] ?? $googleData['year'];
            }
        }

        // 5 insert into db
        $stmt = $conn->prepare("
            INSERT INTO books (isbn, title, author, genre, publisher, year)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "sssssi",
            $isbn,
            $bookData['title'],
            $bookData['author'],
            $bookData['genre'],
            $bookData['publisher'],
            $bookData['year']
        );
        $stmt->execute();
        return $stmt->insert_id;
    }

    // open library api
    private static function fetchFromOpenLibrary(string $isbn): array {
        $url = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";
        $data = self::fetchJson($url);
        if (empty($data)) return [];

        $book = reset($data);
        return [
            'title'     => $book['title'] ?? null,
            'author'    => $book['authors'][0]['name'] ?? null,
            'publisher' => $book['publishers'][0]['name'] ?? null,
            'genre'     => $book['subjects'][0]['name'] ?? null,
            'year'      => self::extractYear($book['publish_date'] ?? null),
        ];
    }

    // google api
    private static function fetchFromGoogleFull(string $isbn): ?array {
        $apiKey = GOOGLE_BOOKS_API_KEY;
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn&key=$apiKey";
        $data = self::fetchJson($url);
        if (empty($data['items'])) return null;

        $volume = $data['items'][0]['volumeInfo'] ?? [];
        return [
            'title'     => $volume['title'] ?? null,
            'author'    => isset($volume['authors']) ? implode(', ', $volume['authors']) : null,
            'publisher' => $volume['publisher'] ?? null,
            'genre'     => isset($volume['categories']) ? implode(', ', $volume['categories']) : null,
            'year'      => self::extractYear($volume['publishedDate'] ?? null),
        ];
    }

    // cURL json fetch
    private static function fetchJson(string $url): ?array {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $json = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$json) return null;
        return json_decode($json, true);
    }

    // extract year
    private static function extractYear(?string $date): ?int {
        if (!$date) return null;
        preg_match('/\d{4}/', $date, $m);
        return isset($m[0]) ? (int)$m[0] : null;
    }

    // convert isbn 10 to isbn 13
    private static function isbn13to10(string $isbn13): string {
        $isbn = substr($isbn13, 3, 9); // remove '978'
        $sum = 0;
        for ($i = 0; $i < 9; $i++) $sum += ($i + 1) * $isbn[$i];
        $check = $sum % 11;
        return $isbn . ($check === 10 ? 'X' : $check);
    }
}