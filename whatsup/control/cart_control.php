<?php
require("../../model/cart_model.php");

function setCart($musicNumber,$album,$price,$amount){
	$cart = new CART();
	$cart->setMusicNumber($musicNumber);
	$cart->setAlbum($album);
	$cart->setPrice($price);
	$cart->setAmount($amount);
	return $cart;
}

function getProductByMusicNumber($ID){
	$cartxml = new CARTXML();
	return $cartxml->getProductByMusicNumber($ID);
}

function insertCart($Product){
	$cartxml = new CARTXML();
	$cartxml->insertCart($Product);
}

function modifyCart($cart){
	$cartxml = new CARTXML();
	$cartxml->modifyCart($cart);
}

function  deleteProductByMusicNumber($ID){
	$cartxml = new CARTXML();
	$cartxml->deleteProductByMusicNumber($ID);
}

function  getSum(){
	$cartxml = new CARTXML();
	return $cartxml->getSum();
}

function  showAllProduct(){
	$cartxml = new CARTXML();
	return $cartxml->showAllProduct();
}



function clearCart(){
	$cartxml = new CARTXML();
	$cartxml->clearCart();
}
?>