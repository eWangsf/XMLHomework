<?php
header('Content-Type: text/html; charset=utf-8');
class ORDER {
	private $orderDate;
	private $userName;
	private $orderID;
	private $product = array();
	
	private $Recipient = array (
			"RecipientName" => null,
			"Address" => null,
			"Zip" => null,
			"RecipientPhone" => null
	);
	private $paymentMethod;
	private $remark;
	private $deliver;

	function setOrderDate($date) {
		$this->orderDate = $date;
	}
	function getOrderDate() {
		return $this->orderDate;
	}
	function setOrderID($ID) {
		$this->orderID = $ID;
	}
	function getOrderID() {
		return $this->orderID;
	}
	function setUserName($userName) {
		$this->userName = $userName;
	}
	function getUserName() {
		return $this->userName;
	}
	
	function  setProduct($products){
		foreach ($products as $product){
			$musicNumber = $product['MusicNumber'];
			$amount = $product['Amount'];
			
			$temp['MusicNumber'] = $musicNumber;
			$temp['Amount'] = $amount;
			
			array_push($this->product, $temp);
		};
	}
	
	function getProduct() {
		return $this->product;
	}
	function setMusicNumber($musicNumber) {
		$this->product['MusicNumber'] = $musicNumber;
	}
	function getMusicNumber() {
		return $this->product['MusicNumber'];
	}
	function setAmount($amount) {
		$this->product['Amount'] = $amount;
	}
	function getAmount() {
		return $this->product['Amount'];
	}
	function setRecipient($recipientName, $address, $zip, $recipientPhone) {
		$this->Recipient = array (
				"RecipientName" => $recipientName,
				"Address" => $address,
				"Zip" => $zip,
				"RecipientPhone" => $recipientPhone
		);
	}
	function getRecipient() {
		return $this->Recipient;
	}
	function setRecipientName($name) {
		$this->Recipient['RecipientName'] = $name;
	}
	function getRecipientName() {
		return $this->Recipient['RecipientName'];
	}
	function setAddress($address) {
		$this->Recipient['Address'] = $address;
	}
	function getAddress() {
		return $this->Recipient['Address'];
	}
	function setZip($zip) {
		$this->Recipient['Zip'] = $zip;
	}
	function getZip() {
		return $this->Recipient['Zip'];
	}
	function setRecipientPhone($recipientPhone) {
		$this->Recipient['RecipientPhone'] = $recipientPhone;
	}
	function getRecipientPhone() {
		return $this->Recipient['RecipientPhone'];
	}
	function setPaymentMethod($paymentMethod) {
		$this->paymentMethod = $paymentMethod;
	}
	function getPaymentMethod() {
		return $this->paymentMethod;
	}
	function setRemark($remark) {
		$this->remark = $remark;
	}
	function getRemark() {
		return $this->remark;
	}
	function setDeliver($deliver) {
		$this->deliver = $deliver;
	}
	function getDeliver() {
		return $this->deliver;
	}
}

class ORDERXML{
	private $doc;
	function __construct() {
		$this->doc = new DOMDocument();
		$this->doc->load('../order/order.xml');
	}

	function getOrderByID($ID){
		$Orders = $this->doc->getElementsByTagName("Order");
		foreach ($Orders as $Order) {
			$name = $Order->getElementsByTagName("OrderId")->item(0)->nodeValue;
			if (strcasecmp($name, $ID) == 0) {
				$tempOrder = new ORDER();
				$tempOrder->setOrderDate($Order->getAttribute("date"));
				$tempOrder->setOrderID($Order->getElementsByTagName("OrderId")->item(0)->childNodes->item(0)->nodeValue);
				$tempOrder->setUserName($Order->getElementsByTagName("UserName")->item(0)->childNodes->item(0)->nodeValue);
				$musicNumber = $Order->getElementsByTagName("MusicNumber")->item(0)->childNodes->item(0)->nodeValue;
				$amount = $Order->getElementsByTagName("Amount")->item(0)->childNodes->item(0)->nodeValue;
				$tempOrder->setProduct($musicNumber,$amount);
				$recipientName = $Order->getElementsByTagName("RecipientName")->item(0)->childNodes->item(0)->nodeValue;
				$address = $Order->getElementsByTagName("Address")->item(0)->childNodes->item(0)->nodeValue;
				$zip = $Order->getElementsByTagName("Zip")->item(0)->childNodes->item(0)->nodeValue;
				$recipientPhone = $Order->getElementsByTagName("RecipientPhone")->item(0)->childNodes->item(0)->nodeValue;
				$tempOrder->setRecipient($recipientName,$address,$zip,$recipientPhone);
				$tempOrder->setPaymentMethod($Order->getElementsByTagName("PaymentMethod")->item(0)->childNodes->item(0)->nodeValue);
				$tempOrder->setRemark($Order->getElementsByTagName("Remark")->item(0)->childNodes->item(0)->nodeValue);
				$tempOrder->setDeliver($Order->getElementsByTagName("Deliver")->item(0)->childNodes->item(0)->nodeValue);

				return $tempOrder;
			}
		}
	}

	function insertOrder($order){
		$newOrder = $this->doc->createElement("Order");
		$newOrder->setAttribute("date", $order->getOrderDate());

		$newOrderID = $this->doc->createElement("OrderId");
		$orderCount = $this->doc->getElementsByTagName("orderCount");
		$orderCount = $orderCount->item(0)->childNodes->item(0)->nodeValue + 1;
		$cdate = getdate();
		$cdate = $cdate['year'].$cdate['mon'].$cdate['mday'];
		$text = $this->doc->createTextNode($cdate .'-'. $orderCount);
		$newOrderID->appendChild($text);
		$newOrder->appendChild($newOrderID);

		$newUserName = $this->doc->createElement("UserName");
		$text = $this->doc->createTextNode($order->getUserName());
		$newUserName->appendChild($text);
		$newOrder->appendChild($newUserName);

		$newProduct = $this->doc->createElement("Product");
		$Products = $order->getProduct();
		foreach ($Products as $Product){
			$musicNumber = $Product['MusicNumber'];
			$amount = $Product['Amount'];
			$newProductMusicNumber = $this->doc->createElement("MusicNumber");
			$text = $this->doc->createTextNode($musicNumber);
			$newProductMusicNumber->appendChild($text);
			$newProduct->appendChild($newProductMusicNumber);
			$newProductAmount = $this->doc->createElement("Amount");
			$text = $this->doc->createTextNode($amount);
			$newProductAmount->appendChild($text);
			$newProduct->appendChild($newProductAmount);
			$newOrder->appendChild($newProduct);
		}
		
		$newRecipient = $this->doc->createElement("Recipient");
		$recipientName = $order->getRecipientName();
		$address = $order->getAddress();
		$zip = $order->getZip();
		$recipientPhone = $order->getRecipientPhone();

		$newRecipientName = $this->doc->createElement("RecipientName");
		$text = $this->doc->createTextNode($recipientName);
		$newRecipientName->appendChild($text);
		$newRecipient->appendChild($newRecipientName);
		$newAddress = $this->doc->createElement("Address");
		$text = $this->doc->createTextNode($address);
		$newAddress->appendChild($text);
		$newRecipient->appendChild($newAddress);
		$newZip = $this->doc->createElement("Zip");
		$text = $this->doc->createTextNode($zip);
		$newZip->appendChild($text);
		$newRecipient->appendChild($newZip);
		$newRecipientPhone = $this->doc->createElement("RecipientPhone");
		$text = $this->doc->createTextNode($recipientPhone);
		$newRecipientPhone->appendChild($text);
		$newRecipient->appendChild($newRecipientPhone);
		$newOrder->appendChild($newRecipient);

		$newPaymentMethod = $this->doc->createElement("PaymentMethod");
		$text = $this->doc->createTextNode($order->getPaymentMethod());
		$newPaymentMethod->appendChild($text);
		$newOrder->appendChild($newPaymentMethod);

		$newRemark = $this->doc->createElement("Remark");
		$text = $this->doc->createTextNode($order->getRemark());
		$newRemark->appendChild($text);
		$newOrder->appendChild($newRemark);

		$newDeliver = $this->doc->createElement("Deliver");
		$text = $this->doc->createTextNode($order->getDeliver());
		$newDeliver->appendChild($text);
		$newOrder->appendChild($newDeliver);

		$root = $this->doc->getElementsByTagName("OrderList");
		$root->item(0)->appendChild($newOrder);
		$this->doc->getElementsByTagName("orderCount")->item(0)->childNodes->item(0)->nodeValue = $orderCount;
		$this->doc->save("../order/order.xml");
		
		return true;
	}

	function modifyOrder($oldOrder) {
		$Orders = $this->doc->getElementsByTagName("Order");
		foreach ($Orders as $Order) {
			$name = $Order->getElementsByTagName("OrderId")->item(0)->nodeValue;
			if (strcasecmp($name, $oldOrder->getOrderID()) == 0) {
				$Order->setAttribute("date",$oldOrder->getOrderDate());
				$Order->getElementsByTagName("UserName")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getUserName();
				$Order->getElementsByTagName("MusicNumber")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getMusicNumber();
				$Order->getElementsByTagName("Amount")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getAmount();
				$Order->getElementsByTagName("RecipientName")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getRecipientName();
				$Order->getElementsByTagName("Address")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getAddress();
				$Order->getElementsByTagName("Zip")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getZip();
				$Order->getElementsByTagName("RecipientPhone")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getRecipientPhone();
				$Order->getElementsByTagName("PaymentMethod")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getPaymentMethod();
				$Order->getElementsByTagName("Remark")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getRemark();
				$Order->getElementsByTagName("Deliver")->item(0)->childNodes->item(0)->nodeValue = $oldOrder->getDeliver();
				$this->doc->save("../order/order.xml");
				break;
			}
		}


	}

	function deleteOrderByID($ID){
		$Orders = $this->doc->getElementsByTagName("Order");
		foreach ($Orders as $Order) {
			$name = $Order->getElementsByTagName("OrderID")->item(0)->nodeValue;
			if (strcasecmp($name, $ID) == 0) {
				break;
			}
		}
		$this->doc->documentElement->removeChild($Order);
		$this->doc->save("../order/order.xml");
	}
	
	function getOrderID(){
		$orderCount = $this->doc->getElementsByTagName("orderCount");
		$orderCount = $orderCount->item(0)->childNodes->item(0)->nodeValue;
		$cdate = getdate();
		$cdate = $cdate['year'].$cdate['mon'].$cdate['mday'];
		$orderID = $cdate .'-'. $orderCount;
		return $orderID;
	}
}
?>