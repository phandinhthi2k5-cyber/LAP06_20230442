<?php
$books = json_decode(file_get_contents("../data/books.json"), true) ?? [];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin sách</title>
    <link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
<div class="petals">
</div>
<div class="container">
    <h2>Danh sách sách</h2>

    <table>
        <thead>
            <tr class="table-head">
                <th>Mã</th>
                <th>Tên</th>
                <th>Tác giả</th>
                <th>Năm</th>
                <th>Loại</th>
                <th>SL</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($books as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['title'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['author'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['year'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['cat'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['qty'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
  <script src="/lab06_20230442/css/petals.js"></script>
</body>
</html>
