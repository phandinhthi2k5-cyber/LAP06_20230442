<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Không truy cập trực tiếp. <a href='register_member.php'>Quay lại</a>";
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$address = trim($_POST['address'] ?? '');

$errors = [];

if ($name === '') $errors[] = "Họ tên bắt buộc";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ";
if (!preg_match('/^\d{9,11}$/', $phone)) $errors[] = "SĐT phải 9–11 số";
if ($dob === '') $errors[] = "Ngày sinh bắt buộc";

if ($errors) {
    echo "<ul style='color:red'>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><a href='register_member.php'>Quay lại</a>";
    exit;
}

$file = fopen("../data/members.csv", "a");
fputcsv($file, [$name, $email, $phone, $dob, $gender, $address]);
fclose($file);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title></title>
    <link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
   <div class="petals"></div>

<div class="container">
<h3>Đăng ký thành công</h3>
<ul>
<li><?= htmlspecialchars($name) ?></li>
<li><?= htmlspecialchars($email) ?></li>
<li><?= htmlspecialchars($phone) ?></li>
</ul>
 <a href="register_member.php">Quay lại</a>
</div>
  <script src="/lab06_20230442/css/petals.js"></script>
</body>
</div>
