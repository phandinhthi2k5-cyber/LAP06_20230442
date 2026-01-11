<?php
$errors = [];
$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $year = (int)($_POST['year'] ?? 0);
    $cat = $_POST['category'] ?? '';
    $qty = (int)($_POST['qty'] ?? -1);

    foreach ($books as $b)
        if ($b['id'] === $id) $errors[] = "Trùng mã sách";

    if ($id==''||$title==''||$author=='') $errors[]="Không để trống";
    if ($year<1900||$year>date('Y')) $errors[]="Năm sai";
    if ($qty<0) $errors[]="Số lượng ≥0";

    if (!$errors) {
        $books[] = compact('id','title','author','year','cat','qty');
        file_put_contents("../data/books.json", json_encode($books, JSON_PRETTY_PRINT));
        header("Location: list_books.php"); exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title>Thêm sách vào kho thư viện</title>
<link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
    <div class="petals">
</div>
<div class="container">
<form method="post">
Mã: <input name="id"><br>
Tên: <input name="title"><br>
Tác giả: <input name="author"><br>
Năm: <input type="number" name="year"><br>
Thể loại:
<select name="category">
<option>Giáo trình</option><option>Kỹ năng</option>
<option>Văn học</option><option>Khoa học</option><option>Khác</option>
</select><br>
SL: <input type="number" name="qty"><br>
<button>Thêm</button>
</form>
<?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>
</div>
  <script src="/lab06_20230442/css/petals.js"></script>
</body> 
</html>