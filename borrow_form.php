<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title>Mượn sách</title>
<link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
    <div class="petals">
</div>
    <div class="container">
<h2>Phiếu mượn sách</h2>
<form method="post" action="borrow_process.php">
Mã thành viên: <input name="member_id" required><br>
Mã sách: <input name="book_id" required><br>
Ngày mượn: <input type="date" name="borrow_date" required><br>
Số ngày mượn (1–30): <input type="number" name="days" min="1" max="30" required><br><br>
<button>Mượn sách</button>
</form>
    </div>
      <script src="/lab06_20230442/css/petals.js"></script>
</body>
</html>
