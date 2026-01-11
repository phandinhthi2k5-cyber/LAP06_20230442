<?php
$kw = trim($_GET['kw'] ?? '');
$cat = $_GET['category'] ?? 'all';

$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];
$results = [];

foreach ($books as $b) {
    if ($kw && stripos($b['title'], $kw) === false) continue;
    if ($cat !== 'all' && $b['cat'] !== $cat) continue;
    $results[] = $b;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title>Trang tìm kiếm & lọc dữ liệu (GET) cho Thư viện hoặc Cửa hàng</title>
    <link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
    <div class="petals">
</div>
<div class="container">
<form method="get">
Từ khóa: <input name="kw" value="<?= htmlspecialchars($kw) ?>">
Thể loại:
<select name="category">
<option value="all">Tất cả</option>
<option>Khoa học</option>
<option>Văn học</option>
<option>Kỹ năng</option>
</select>
<button>Tìm</button>
</form>

<?php if (!$results): ?>
<p>Không có kết quả</p>
<?php else: ?>
<table border="1">
<tr><th>Mã</th><th>Tên</th><th>Loại</th></tr>
<?php foreach ($results as $r): ?>
<tr>
<td><?= htmlspecialchars($r['id']) ?></td>
<td><?= htmlspecialchars($r['title']) ?></td>
<td><?= htmlspecialchars($r['cat']) ?></td>
</tr>
<?php endforeach ?>
</table>
<?php endif ?>
</div>
  <script src="/lab06_20230442/css/petals.js"></script>
</body>
</html>