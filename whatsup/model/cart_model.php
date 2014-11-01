<?php
header('Content-Type: text/html; charset=utf-8');
class CART {
	private $MusicNumber;
	private $Album;
	private $Price;
	private $Amount;

	function setMusicNumber($musicNumber) {
		$this->MusicNumber = $musicNumber;
	}
	function getMusicNumber() {
		return $this->MusicNumber;
	}
	function setAlbum($album) {
		$this->Album = $album;
	}
	function getAlbum() {
		return $this->Album;
	}
	function setPrice($price) {
		$this->Price = $price;
	}
	function getPrice() {
		return $this->Price;
	}
	function setAmount($amount) {
		$this->Amount = $amount;
	}
	function getAmount() {
		return $this->Amount;
	}
}

class CARTXML{
	private $doc;
	function __construct() {
		$this->doc = new DOMDocument();
		$this->doc->load('../cart/cart.xml');
	}

	function getProductByMusicNumber($ID){
		$Products = $this->doc->getElementsByTagName("Product");
		foreach ($Products as $Product) {
			$name = $Product->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($name, $ID) == 0) {
				$tempCart = new CART();
				$tempCart->setMusicNumber($Product->getElementsByTagName("MusicNumber")->item(0)->childNodes->item(0)->nodeValue);
				$tempCart->setAlbum($Product->getElementsByTagName("Album")->item(0)->childNodes->item(0)->nodeValue);
				$tempCart->setAmount($Product->getElementsByTagName("Amount")->item(0)->childNodes->item(0)->nodeValue);
				$tempCart->setPrice($Product->getElementsByTagName("Price")->item(0)->childNodes->item(0)->nodeValue);

				return $tempCart;
			}
		}
	}

	function insertCart($Product){
		$newCart = $this->doc->createElement("Product");

		$newMusicNumber = $this->doc->createElement("MusicNumber");
		$text = $this->doc->createTextNode($Product->getMusicNumber());
		$newMusicNumber->appendChild($text);
		$newCart->appendChild($newMusicNumber);

		$newAlbum = $this->doc->createElement("Album");
		$text = $this->doc->createTextNode($Product->getAlbum());
		$newAlbum->appendChild($text);
		$newCart->appendChild($newAlbum);

		$newPrice = $this->doc->createElement("Price");
		$text = $this->doc->createTextNode($Product->getPrice());
		$newPrice->appendChild($text);
		$newCart->appendChild($newPrice);

		$newAmount = $this->doc->createElement("Amount");
		$text = $this->doc->createTextNode($Product->getAmount());
		$newAmount->appendChild($text);
		$newCart->appendChild($newAmount);

		$root = $this->doc->getElementsByTagName("Cart");
		$root->item(0)->appendChild($newCart);
		$this->doc->save("../cart/cart.xml");
	}

	function modifyCart($oldCart) {
		$Products = $this->doc->getElementsByTagName("Product");
		foreach ($Products as $Product) {
			$name = $Product->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($name, $oldCart->getMusicNumber()) == 0) {
				$Product->getElementsByTagName("MusicNumber")->item(0)->childNodes->item(0)->nodeValue = $oldCart->getMusicNumber();
				$Product->getElementsByTagName("Album")->item(0)->childNodes->item(0)->nodeValue = $oldCart->getAlbum();
				$Product->getElementsByTagName("Price")->item(0)->childNodes->item(0)->nodeValue = $oldCart->getPrice();
				$Product->getElementsByTagName("Amount")->item(0)->childNodes->item(0)->nodeValue = $oldCart->getAmount();
				$this->doc->save("../cart/cart.xml");
			}
		}


	}

	function deleteProductByMusicNumber($ID){
		$Products = $this->doc->getElementsByTagName("Product");
		foreach ($Products as $Product) {
			$name = $Product->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($name, $ID) == 0) {
				$this->doc->documentElement->removeChild($Product);
				$this->doc->save("../cart/cart.xml");
				break;
			}
		}

	}

	function getSum(){
		$sum = 0;
		$Products = $this->doc->getElementsByTagName("Product");
		foreach ($Products as $Product) {
			$price = $Product->getElementsByTagName("Price")->item(0)->nodeValue;
			$amount = $Product->getElementsByTagName("Amount")->item(0)->nodeValue;
			$sum += $price * $amount;
		}
		return $sum;
	}
	
	function makeProduct($cart){
		$Product = new CART();
		$Product->setAlbum($cart->getElementsByTagName("Album")->item(0)->nodeValue);
		$Product->setAmount($cart->getElementsByTagName("Amount")->item(0)->nodeValue);
		$Product->setMusicNumber($cart->getElementsByTagName("MusicNumber")->item(0)->nodeValue);
		$Product->setPrice($cart->getElementsByTagName("Price")->item(0)->nodeValue);
		return $Product;
	}
	
	function showAllProduct(){
		$Products = array();
		$carts = $this->doc->getElementsByTagName("Product");
		foreach ($carts as $cart)
		{
			$Product = $this->makeProduct($cart);
			array_push($Products, $Product);
		}
		return $Products;
	}
	
	
	
	function clearCart(){
		$products = showAllProduct();
		foreach ($products as $product){
			deleteProductByMusicNumber($product->getMusicNumber());
		}
	}
}
?>