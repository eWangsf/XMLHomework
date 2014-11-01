<?php
require '../../model/cd_model.php';
header('Content-Type: text/html; charset=UTF-8');
class Admin
{
	/**
	 * Admin 对象，定义了Admin各种属性，分别对应xml文件里的各个子结点
	 * 定义实现了各种set、get函数
	 */
	private $adminName;
	private $adminPassword;
	
	function setAdminName($adminName)
	{
		$this->adminName = $adminName;
	}
	
	function getAdminName()
	{
		return $this->adminName;
	}
	
	function setAdminPassword($adminPassword)
	{
		$this->adminPassword=$adminPassword;
	}
	
	function getAdminPassword()
	{
		return $this->adminPassword;
	}
}

class AdminXML
{
	private $doc;
	
	function __construct()
	{
		$this->doc = new DOMDocument();
		$this->doc->load('../admin/admin.xml');
	}
	
	function getNextSibling($node)
	{
		$x = $node->nextSibling;
		while($x->nodeType != 1)
		{
			$x = $x->nextSibling;
		}
		return $x;
	}
	
	function getAdminByAdminName($adminName)
	{
		$admins = $this->doc->getElementsByTagName("manager");
		foreach($admins as $admin)
		{
			$name = $admin->getElementsByTagName("adminName")->item(0)->nodeValue;
			if(strcasecmp($adminName, $name)==0)
			{			
				$tempAdmin = new Admin();
				$tempAdmin->setAdminName($name);
				$tempAdmin->setAdminPassword($admin->getElementsByTagName("adminPassword")->item(0)->nodeValue);
				return $tempAdmin;
			}
		}
	}
	
	function insertAdmin($admin)
	{
		$newAdmin = $this->doc->createElement("manager");
		
		$newAdminName = $this->doc->createElement("adminName");
		$text = $this->doc->createTextNode($admin->getAdminName());
		$newAdminName->appendChild($text);
		$newAdmin->appendChild($newAdminName);
		
		$newAdminPassword = $this->doc->createElement("adminPassword");
		$text = $this->doc->createTextNode($admin->getAdminPassword());
		$newAdminPassword->appendChild($text);
		$newAdmin->appendChild($newAdminPassword);
		
		$root = $this->doc->getElementById("managers");
		$root->item(0)->appendChild($newAdmin);
		$this->doc->save("../admin/admin.xml");
		
		return 1;
	}
	
	function modifyAdmin($newAdmin) 
	{
		$admins = $this->doc->getElementsByTagName("manager");
		foreach ($admins as $admin) 
		{
			$name = $admin->getElementsByTagName("adminName")->item(0)->nodeValue;
			if (strcasecmp($name, $newAdmin->getAdminName()) == 0)
			{
				$admin->getElementsByTagName("adminName")->item(0)->nodeValue = $newUser->getAdminName();
				$admin->getElementsByTagName("adminPassword")->item(0)->nodeValue = $newUser->getAdminPassword();
				$this->doc->save("../admin/admin.xml");
				break;
			}
		}	
	
	}
	
	function deleteAdminByAdminName($name) {
		$admins = $this->doc->getElementsByTagName("manager");
		foreach ($admins as $admin) {
			$adminName = $admin->getElementsByTagName("adminName")->item(0)->nodeValue;
			if (strcasecmp($name, $adminName) == 0) {
				break;
			}
		}
	
		$this->doc->documentElement->removeChild($admin);
		$this->doc->save("admin.xml");
	}
	
	function uploadCD($cdArray,$songArray)
	{
		$cd = new CD();
		$date = getdate();
		$uploadDate = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
		$cd->setUploadDate($uploadDate);
		$cd->setBigPicture($cdArray['image_w']);		
		$cd->setSmallPicture($cdArray['image_b']);
	    foreach($songArray as $song)
	    {
	    	$cd->addSongs($song);
	    }
			
		$cd->setAlbum($cdArray['album']);
		$cd->setDealer($cdArray['dealer']);
		$cd->setDescription($cdArray['description']);
		$cd->setLanguage($cdArray['language']);
		$cd->setMusicNumber($cdArray['musicNumber']);
		$cd->setPopularity($cdArray['popularity']);
		$cd->setPrice($cdArray['price']);
		$cd->setPublisher($cdArray['publisher']);
		$cd->setSinger($cdArray['name'], $cdArray['sex'], $cdArray['area']);
		$cd->setStorage($cdArray['storage']);
		$cdXML = new CDXML();
		$cdXML->insertCD($cd);
	}
	
	function modify_CD($cdArray,$songArray)
	{
		$cd = new CD();
		$cd->setAlbum($cdArray['album']);
		$cd->setDealer($cdArray['dealer']);
		$cd->setDescription($cdArray['description']);
		$cd->setLanguage($cdArray['language']);
		$cd->setMusicNumber($cdArray['musicNumber']);
		$cd->setPopularity($cdArray['popularity']);
		$cd->setPrice($cdArray['price']);
		$cd->setPublisher($cdArray['publisher']);
		$cd->setSinger($cdArray['name'], $cdArray['sex'], $cdArray['area']);
		$cd->setStorage($cdArray['storage']);
		$cd->setUploadDate($cdArray['uploadDate']);
		$cd->setMusicNumber($cdArray['musiceNumber']);
		$cd->setBigPicture($cdArray["image_w"]);
		$cd->setSmallPicture($cdArray["image_b"]);
		foreach ($songArray as $song)
		{
			$cd->addSongs($song);
		}
		$cdXML = new CDXML();
		$cdXML->modifyCD($cd);
	}
	
}
?>