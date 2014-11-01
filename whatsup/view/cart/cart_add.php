<?php
require("../../control/cart_control.php");
require("../../control/cd_control.php");

$musicNumber = $_POST['musicNumber'];
$amount = $_POST['amount'];

$CD = getCDByID($musicNumber);
$cart = setCart($musicNumber, $CD->getAlbum(), $CD->getPrice(), $amount);
$oldProduct = getProductByMusicNumber($musicNumber);

if($oldProduct) {
	$cart->setAmount($amount+$oldProduct->getAmount());
	modifyCart($cart);
}
else {
	insertCart($cart);
}
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<body>
	<script>alert('添加至购物车成功');window.self.location='../CD/show_all_CD.php'</script>
</body>
</html>
