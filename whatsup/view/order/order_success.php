<?php
require("../../control/order_control.php");
require("../../control/cart_control.php");
require("../../control/cd_control.php");

$RecipientName = $_POST['RecipientName'];
$Address = $_POST['Address'];
$Zip = $_POST['Zip'];
$RecipientPhone = $_POST['RecipientPhone'];
$PaymentMethod = $_POST['PaymentMethod'];
$Remark = $_POST['Remark'];

$carts = showAllProduct();
$products = array();


foreach ($carts as $cart){
	$product['MusicNumber'] = $cart->getMusicNumber();
	$product['Amount'] = $cart->getAmount();
	
	$cd = getCDByID($product['MusicNumber']);
	$storage = $cd->getStorage();
	$storage -= $product['Amount'];
	$cd->setStorage($storage);
	modifyCD($cd);
	array_push($products, $product);
}

$date = getdate();
$date = $date['year'].'-'.$date['mon'].'-'.$date['mday'];

$order = setOrder($date, "0", "fujunbin", $products, $RecipientName, $Address, $Zip, $RecipientPhone, $PaymentMethod, $Remark, "未派送");
insertOrder($order);
clearCart();

echo 'OrderID is '.getOrderID();
?>