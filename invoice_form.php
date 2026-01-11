<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = [];
    for ($i=0;$i<3;$i++) {
        $name = trim($_POST['name'][$i]);
        $qty = (int)$_POST['qty'][$i];
        $price = (int)$_POST['price'][$i];
        if ($name && $qty>0 && $price>0)
            $items[] = compact('name','qty','price');
    }

    if (!$items) die("Phải có ít nhất 1 hàng hợp lệ");

    $discount = (int)$_POST['discount'];
    $vat = (int)$_POST['vat'];

    $subtotal = 0;
    foreach ($items as $i) $subtotal += $i['qty']*$i['price'];

    $total = $subtotal * (1-$discount/100) * (1+$vat/100);

    $invoice = compact('items','subtotal','discount','vat','total');
    $file = "../data/invoices/invoice_".time().".json";
    file_put_contents($file, json_encode($invoice, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo hóa đơn bán hàng mini</title>
    <link rel="stylesheet" href="/lab06_20230442/css/style.css">
</head>
<body>
<div class="petals">
</div>
<div class="container">
    <h2>Tạo hóa đơn bán hàng</h2>

    <form method="post">

        <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="invoice-row">
            <input type="text" name="name[]" placeholder="Tên hàng">
            <input type="number" name="qty[]" placeholder="SL" min="1">
            <input type="number" name="price[]" placeholder="Đơn giá" min="1">
        </div>
        <?php endfor; ?>

        <div class="invoice-summary">
            <input type="number" name="discount" placeholder="Giảm giá (%)" value="0" min="0" max="30">
            <input type="number" name="vat" placeholder="VAT (%)" value="0" min="0" max="15">
        </div>

        <button type="submit">Tính tiền</button>
    </form>
</div>
    <?php if (!empty($invoice)): ?>
        <div class="success">
            <h3>Tổng tiền: <?= number_format($total) ?> VND</h3>
        </div>
    <?php endif; ?>
  <script src="/lab06_20230442/css/petals.js"></script>
</body>
</html>

