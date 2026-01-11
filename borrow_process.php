<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Không truy cập trực tiếp. <a href='borrow_form.php'>Quay lại</a>";
    exit;
}

$memberId = trim($_POST['member_id'] ?? '');
$bookId = trim($_POST['book_id'] ?? '');
$borrowDate = $_POST['borrow_date'] ?? '';
$days = (int)($_POST['days'] ?? 0);
$errors = [];

/* Kiểm tra thành viên */
$members = file("../data/members.csv");
$memberExists = false;
foreach ($members as $m) {
    if (str_contains($m, $memberId)) {
        $memberExists = true;
        break;
    }
}
if (!$memberExists) $errors[] = "Mã thành viên không tồn tại";

/* Kiểm tra sách */
$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];
$bookIndex = -1;
foreach ($books as $i => $b) {
    if ($b['id'] === $bookId) {
        $bookIndex = $i;
        break;
    }
}
if ($bookIndex === -1) $errors[] = "Mã sách không tồn tại";
elseif ($books[$bookIndex]['qty'] <= 0) $errors[] = "Sách đã hết";

/* Validate ngày */
if ($days < 1 || $days > 30) $errors[] = "Số ngày mượn không hợp lệ";

if ($errors) {
    echo "<ul style='color:red'>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><a href='borrow_form.php'>Quay lại</a>";
    exit;
}

/* Ghi phiếu */
$borrows = json_decode(file_get_contents("../data/borrows.json"), true) ?? [];
$borrowId = "PM" . time();
$returnDate = date('Y-m-d', strtotime("$borrowDate +$days days"));

$borrows[] = [
    'id' => $borrowId,
    'member' => $memberId,
    'book' => $bookId,
    'borrow_date' => $borrowDate,
    'return_date' => $returnDate,
    'status' => 'Đang mượn'
];
file_put_contents("../data/borrows.json", json_encode($borrows, JSON_PRETTY_PRINT));

/* Trừ số lượng sách */
$books[$bookIndex]['qty']--;
file_put_contents("../data/books.json", json_encode($books, JSON_PRETTY_PRINT));

echo "<h3>Mượn sách thành công</h3>";
echo "Mã phiếu: $borrowId";
