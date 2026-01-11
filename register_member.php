<?php
$errors = [];
$data = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'dob' => '',
    'gender' => '',
    'address' => ''
];
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Đăng ký thẻ</title>
<link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
    <div class="petals"></div>
    <div class="container">
<h2>Đăng ký thẻ thư viện</h2>

<?php if (!empty($errors)): ?>
<ul style="color:red">
<?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
</ul>
<?php endif; ?>

<form method="post" action="member_result.php">
Họ tên*: <input name="name" value="<?= htmlspecialchars($data['name']) ?>"><br>
Email*: <input name="email" type="email" value="<?= htmlspecialchars($data['email']) ?>"><br>
SĐT*: <input name="phone" value="<?= htmlspecialchars($data['phone']) ?>"><br>
Ngày sinh*: <input type="date" name="dob" value="<?= htmlspecialchars($data['dob']) ?>"><br>
Giới tính:
<div class="radio-group">
    <label class="radio-item">
        <input type="radio" name="gender" value="nam"> Nam
    </label>

    <label class="radio-item">
        <input type="radio" name="gender" value="nu"> Nữ
    </label>
    <label class="radio-item">
      <input type="radio" name="gender" value="Khác">Khác
    </label>
</div>
Địa chỉ:<br>
<textarea name="address"><?= htmlspecialchars($data['address']) ?></textarea><br><br>
<button type="submit">Đăng ký</button>
<button type="reset">Reset</button>
</form>
    </div>
      <script src="/lab06_20230442/css/petals.js"></script>
</body>
</html>
