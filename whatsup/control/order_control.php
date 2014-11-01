<?php
require("../../model/order_model.php");

function getOrderByID($ID){
	$orderxml = new ORDERXML();
	return $orderxml->getOrderByID($ID);
}

function insertOrder($order){
	$orderxml = new ORDERXML();
	return $orderxml->insertOrder($order);	
}

function deleteOrderByID($ID){
	$orderxml = new ORDERXML();
	return $orderxml->deleteOrderByID($ID);
}

function  modifyOrder($order){
	$orderxml = new ORDERXML();
	return $orderxml->modifyOrder($order);
}

function setOrder($date, $ID, $userName, $products, $recipientName, $address, $zip, $recipientPhone, $paymentMethod, $remark, $deliver){
	$order = new ORDER();
	$order->setOrderDate($date);
	$order->setOrderID($ID);
	$order->setUserName($userName);
	$order->setProduct($products);
	
	$order->setRecipient($recipientName, $address, $zip, $recipientPhone);
	$order->setPaymentMethod($paymentMethod);
	$order->setRemark($remark);
	$order->setDeliver($deliver);
	return $order;
}

function getOrderID(){
	$orderxml = new ORDERXML();
	return $orderxml->getOrderID();
}

?>
