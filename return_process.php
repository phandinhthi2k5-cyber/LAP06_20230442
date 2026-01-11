<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Không truy cập trực tiếp";
    exit;
}

$id = trim($_POST['borrow_id'] ?? '');
$returnDate = $_POST['return_date'] ?? '';

$borrows = json_decode(file_get_contents("../data/borrows.json"), true) ?? [];
$found = false;

foreach ($borrows as &$b) {
    if ($b['id'] === $id && $b['status'] === 'Đang mượn') {
        $b['status'] = 'Đã trả';
        $found = true;

        /* tăng sách */
        $books = json_decode(file_get_contents("../data/books.json"), true);
        foreach ($books as &$book)
            if ($book['id'] === $b['book']) $book['qty']++;
        file_put_contents("../data/books.json", json_encode($books, JSON_PRETTY_PRINT));
        break;
    }
}

if (!$found) {
    echo "Phiếu không tồn tại hoặc đã trả";
    exit;
}

file_put_contents("../data/borrows.json", json_encode($borrows, JSON_PRETTY_PRINT));
echo "<h3>Trả sách thành công</h3>";
