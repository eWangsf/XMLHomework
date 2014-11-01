<?php
class USER {
	private $userName;
	private $userPassword;
	private $Email;
	private $detail = array (
		"Name" => null,
		"Sex" => null,
		"Brithday" => null,
		"Phone" => null,
		"Address" => null,
		"Zip" => null
	);

	function setUserName($userName) {
		$this->userName = $userName;
	}
	function getUserName() {
		return $this->userName;
	}
	function setUserPassword($password) {
		$this->userPassword = $password;
	}
	function getUserPassword() {
		return $this->userPassword;
	}
	function setEmail($Email) {
		return $this->Email = $Email;
	}
	function getEmail() {
		return $this->Email;
	}

	function setDetail($name, $sex, $brithday, $phone, $address, $zip) {
		$this->detail = array (
			"Name" => $name,
			"Sex" => $sex,
			"Brithday" => $brithday,
			"Phone" => $phone,
			"Address" => $address,
			"Zip" => $zip
		);
	}
	function getDetail() {
		return $this->detail;
	}
	function setName($name) {
		$this->detail['Name'] = $name;
	}
	function getName() {
		return $this->detail['Name'];
	}
	function setSex($ser) {
		$this->detail['Sex'] = $ser;
	}
	function getSex() {
		return $this->detail['Sex'];
	}
	function setBrithday($brithday) {
		$this->detail['Brithday'] = $brithday;
	}
	function getBrithday() {
		return $this->detail['Brithday'];
	}
	function setPhone($phone){
		$this->detail['Phone'] = $phone;
	}
	function getPhone(){
		return $this->detail['Phone'];
	}
	function setAddress($address) {
		$this->detail['Address'] = $address;
	}
	function getAddress() {
		return $this->detail['Address'];
	}
	function setZip($zip) {
		$this->detail['Zip'] = $zip;
	}
	function getZip() {
		return $this->detail['Zip'];
	}
}

class USERXML {
	private $doc;

	function __construct() {
		$this->doc = new DOMDocument();
		$this->doc->load('../user/user.xml');
	}

	function getNextSibling($node) {
		$x = $node->nextSibling;
		while ($x->nodeType != 1) {
			$x = $x->nextSibling;
		}
		return $x;
	}

	function getFirstChild($node) {
		$x = $node->firstChild;
		while ($x->nodeType != 1) {
			$x = $x->nextSibling;
		}
		return $x;
	}

	function getUserByUserName($userName) {
		$Users = $this->doc->getElementsByTagName("user");
		foreach ($Users as $user) {
			$name = $user->getElementsByTagName("userName")->item(0)->nodeValue;
			if (strcasecmp($name, $userName) == 0) 
			{
		$tempUser = new USER();
		$tempUser->setUserName($user->getElementsByTagName("userName")->item(0)->nodeValue);
		$tempUser->setUserPassword($user->getElementsByTagName("userPassword")->item(0)->nodeValue);
		$tempUser->setEmail($user->getElementsByTagName("Email")->item(0)->nodeValue);
		$detailName = $this->getFirstChild($user->getElementsByTagName("detail")->item(0));
		$detailSex = $this->getNextSibling($detailName);
		$detailBrithday = $this->getNextSibling($detailSex);
		$detailPhone = $this->getNextSibling($detailBrithday);
		$detailAddress = $this->getNextSibling($detailPhone);
		$detailZip = $this->getNextSibling($detailAddress);
		$tempUser->setDetail($detailName->nodeValue, $detailSex->nodeValue, $detailBrithday->nodeValue, $detailPhone->nodeValue, $detailAddress->nodeValue, $detailZip->nodeValue);
		return $tempUser;
			}
		}

	
	}

	function insertUser($user) {
		$newUser = $this->doc->createElement("user");

		$newUserName = $this->doc->createElement("userName");
		$text = $this->doc->createTextNode($user->getUserName());
		$newUserName->appendChild($text);
		$newUser->appendChild($newUserName);

		$newUserPassword = $this->doc->createElement("userPassword");
		$text = $this->doc->createTextNode($user->getUserPassword());
		$newUserPassword->appendChild($text);
		$newUser->appendChild($newUserPassword);

		$newEmail = $this->doc->createElement("Email");
		$text = $this->doc->createTextNode($user->getEmail());
		$newEmail->appendChild($text);
		$newUser->appendChild($newEmail);

		$newDetail = $this->doc->createElement("detail");
		$Detail = $user->getDetail();
		$Name = $Detail['Name'];
		$Sex = $Detail['Sex'];
		$Brithday = $Detail['Brithday'];
		$Phone = $Detail['Phone'];
		$Address = $Detail['Address'];
		$Zip = $Detail['Zip'];

		$newDetailName = $this->doc->createElement("name");
		$text = $this->doc->createTextNode($Name);
		$newDetailName->appendChild($text);
		$newDetailSex = $this->doc->createElement("sex");
		$text = $this->doc->createTextNode($Sex);
		$newDetailSex->appendChild($text);
		$newDetailBrithday = $this->doc->createElement("brithday");
		$text = $this->doc->createTextNode($Brithday);
		$newDetailBrithday->appendChild($text);
		$newDetailPhone = $this->doc->createElement("phone");
		$text = $this->doc->createTextNode($Phone);
		$newDetailPhone->appendChild($text);
		$newDetailAddress = $this->doc->createElement("address");
		$text = $this->doc->createTextNode($Address);
		$newDetailAddress->appendChild($text);
		$newDetailZip = $this->doc->createElement("zip");
		$text = $this->doc->createTextNode($Zip);
		$newDetailZip->appendChild($text);

		$newDetail->appendChild($newDetailName);
		$newDetail->appendChild($newDetailSex);
		$newDetail->appendChild($newDetailBrithday);
		$newDetail->appendChild($newDetailPhone);
		$newDetail->appendChild($newDetailAddress);
		$newDetail->appendChild($newDetailZip);
		$newUser->appendChild($newDetail);

		$root = $this->doc->getElementsByTagName("users");
		$root->item(0)->appendChild($newUser);
		$this->doc->save("../user/user.xml");
		
		return 1;
	}

	function modifyUser($newUser) {
		$Users = $this->doc->getElementsByTagName("User");
		foreach ($Users as $User) {
			$name = $User->getElementsByTagName("UserName")->item(0)->nodeValue;
			if (strcasecmp($name, $newUser->getUserName()) == 0) {
				$User->getElementsByTagName("UserName")->item(0)->childNodes->item(0)->nodeValue = $newUser->getUserName();
		$User->getElementsByTagName("UserPassword")->item(0)->childNodes->item(0)->nodeValue = $newUser->getUserPassword();
		$User->getElementsByTagName("Email")->item(0)->childNodes->item(0)->nodeValue = $newUser->getEmail();
		$User->getElementsByTagName("RegisterDate")->item(0)->childNodes->item(0)->nodeValue = $newUser->getRegisterDate();
		$User->getElementsByTagName("Name")->item(0)->childNodes->item(0)->nodeValue = $newUser->getName();
		$User->getElementsByTagName("Sex")->item(0)->childNodes->item(0)->nodeValue = $newUser->getSex();
		$User->getElementsByTagName("Brithday")->item(0)->childNodes->item(0)->nodeValue = $newUser->getBrithday();
		$User->getElementsByTagName("Phone")->item(0)->childNodes->item(0)->nodeValue = $newUser->getPhone();
		$User->getElementsByTagName("Address")->item(0)->childNodes->item(0)->nodeValue = $newUser->getAddress();
		$User->getElementsByTagName("Zip")->item(0)->childNodes->item(0)->nodeValue = $newUser->getZip();
		$this->doc->save("../user/user.xml");
		break;
			}
		}

		
	}

	function deleteUserByUserName($name) {
		$Users = $this->doc->getElementsByTagName("User");
		foreach ($Users as $User) {
			$userName = $User->getElementsByTagName("UserName")->item(0)->nodeValue;
			if (strcasecmp($name, $userName) == 0) {
				break;
			}
		}

		$this->doc->documentElement->removeChild($User);
		$this->doc->save("../user/user.xml");
	}
}
?>