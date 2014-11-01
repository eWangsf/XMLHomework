<?php
header('Content-Type: text/html; charset=utf-8');
class CD {
	private $uploadDate;
	private $musicNumber;
	private $album;
	private $bigPicutre;
	private $smallPicture;
	private $singer = array (
		"Name" => " ",
		"Sex" => " ",
		"Area" => " "
	);
	private $songs = array ();
	private $language;
	private $price;
	private $popularity;
	private $storage;
	private $publisher;
	private $dealer;
	private $description;

	function getBigPicture()
	{
		return $this->bigPicutre;
	}
	
	function setBigPicture($bigPicture)
	{
		$this->bigPicutre = $bigPicture;
	}
	
	function getSmallPicture()
	{
		return $this->smallPicture;
	}
	
	function setSmallPicture($smallPicture)
	{
		$this->smallPicture = $smallPicture;
	}
	
	function setUploadDate($uploadDate) {
		$this->uploadDate = $uploadDate;
	}
	function getUploadDate() {
		return $this->uploadDate;
	}
	function setMusicNumber($musicNumber) {
		$this->musicNumber = $musicNumber;
	}
	function getMusicNumber() {
		return $this->musicNumber;
	}

	function setAlbum($album) {
		$this->album = $album;
	}
	function getAlbum() {
		return $this->album;
	}
	function setSinger($name, $sex, $area) {
		/**
		 * @param  name,sex,and area of the singer;
		 */
		$this->singer = array (
			"Name" => $name,
			"Sex" => $sex,
			"Area" => $area
		);
	}
	function getSinger() {
		/**
		 * @return a array with "Name","Sex" and "Area"
		 */
		return $this->singer;
	}
	function setSingerName($name) {
		$this->singer['Name'] = $name;
	}
	function getSingerName() {
		return $this->singer['Name'];
	}
	function setSingerSex($sex) {
		$this->singer['Sex'] = $sex;
	}
	function getSingerSex() {
		return $this->singer['Sex'];
	}
	function setSingerArea($area) {
		$this->singer['Area'] = $area;
	}
	function getSingerArea() {
		return $this->singer['Area'];
	}
	function addSongs($item) {
		array_push($this->songs, $item);
	}
	function modifySongs($n, $song) {
		$this->songs[$n] = $song;
	}
	function getSongs() {
		return $this->songs;
	}
	function setLanguage($language) {
		$this->language = $language;
	}
	function getLanguage() {
		return $this->language;
	}
	function setPrice($price) {
		$this->price = $price;
	}
	function getPrice() {
		return $this->price;
	}
	function setPopularity($popularity) {
		$this->popularity = $popularity;
	}
	function getPopularity() {
		return $this->popularity;
	}
	function setStorage($storage){
		$this->storage = $storage;
	}
	function getStorage(){
		return $this->storage;
	}
	function setPublisher($publisher) {
		$this->publisher = $publisher;
	}
	function getPublisher() {
		return $this->publisher;
	}
	function setDealer($dealer) {
		$this->dealer = $dealer;
	}
	function getDealer() {
		return $this->dealer;
	}
	function setDescription($description) {
		$this->description = $description;
	}
	function getDescription() {
		return $this->description;
	}
}


class CDXML {
	/**
	 * 用于操作cd.xml文件。
	 * 定义了对xml文件的插删改查函数以及几个辅助函数，以一个CD节点为最小单位。
	 */
	private $doc;

	function __construct() {
		$this->doc = new DOMDocument();
		$this->doc->load('../CD/cd.xml');
	}

	function getNextSibling($node) {
		/**
		 * 辅助函数，获取下一个同级节点
		 */
		$x = $node->nextSibling;
		while ($x->nodeType != 1) {
			$x = $x->nextSibling;
		}
		return $x;
	}

	function getFirstChild($node) {
		/**
		 * 辅助函数，获取第一个子节点
		 */
		$x = $node->firstChild;
		while ($x->nodeType != 1) {
			$x = $x->nextSibling;
		}
		return $x;
	}

	function makeCD($Music) {
		/**
		 * 辅助函数，返回一个CD对象
		 */
		$cd = new CD();
		$cd->setAlbum($Music->getElementsByTagName("Album")->item(0)->nodeValue);
		$cd->setBigPicture($Music->getElementsByTagName("bigPicture")->item(0)->nodeValue);
		$cd->setSmallPicture($Music->getElementsByTagName("smallPicture")->item(0)->nodeValue);
		$cd->setUploadDate($Music->getAttribute("UploadDate"));
		$cd->setDealer($Music->getElementsByTagName("Dealer")->item(0)->nodeValue);
		$cd->setDescription($Music->getElementsByTagName("Description")->item(0)->nodeValue);
		$cd->setLanguage($Music->getElementsByTagName("Language")->item(0)->nodeValue);
		$cd->setMusicNumber($Music->getElementsByTagName("MusicNumber")->item(0)->nodeValue);
		$cd->setPopularity($Music->getElementsByTagName("Popularity")->item(0)->nodeValue);
		$cd->setStorage($Music->getElementsByTagName("Storage")->item(0)->nodeValue);
		$cd->setPrice($Music->getElementsByTagName("Price")->item(0)->nodeValue);
		$cd->setPublisher($Music->getElementsByTagName("Publisher")->item(0)->nodeValue);
		$singerName = $this->getFirstChild($Music->getElementsByTagName("Singer")->item(0));
		$singerSex = $this->getNextSibling($singerName);
		$singerArea = $this->getNextSibling($singerSex);
		$cd->setSinger($singerName->nodeValue, $singerSex->nodeValue, $singerArea->nodeValue);
		$items = $Music->getElementsByTagName("Song")->item(0)->childNodes;
		foreach ($items as $item) {
			if ($item->nodeType == 1)
				$cd->addSongs($item->childNodes->item(0)->nodeValue);
		}
		return $cd;
	}

	function getCDByName($name) {
		/**
		 * 传入CD的名称，根据CD名称返回一个CD对象。
		 */
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music) {
			$title = $Music->getElementsByTagName("Album")->item(0)->nodeValue;
			if (strcasecmp($name, $title) == 0) {
				break;
			}
		}
		return $this->makeCD($Music);
	}

	function getCDByID($ID) {
		/**
		 * 传入一个CD的ID，根据CD的ID返回一个CD对象
		 */
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music) {
			$number = $Music->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($ID, $number) == 0) {
				return $this->makeCD($Music);
			}
		}
		
	}
	
	
	function insertCD($cd) {
		/**
		 * 传入一个CD对象，将该CD对象插入到cd.xml文件中。
		 * 
		 */
		$newCD = $this->doc->createElement("Music");
		$newCD->setAttribute("UploadDate", $cd->getUploadDate());

		$newMusicNumber = $this->doc->createElement("MusicNumber");
		$musicCount = $this->doc->getElementsByTagName("MusicCount");
		$musicCount = $musicCount->item(0)->nodeValue + 1;
		$text = $this->doc->createTextNode("CD-" . $musicCount);
		$newMusicNumber->appendChild($text);
		$newCD->appendChild($newMusicNumber);
		
		$newBigPicture = $this->doc->createElement("bigPicture");
		$text = $this->doc->createTextNode($cd->getBigPicture());
		$newBigPicture->appendChild($text);
		$newCD->appendChild($newBigPicture);
		
		$newSmallPicture = $this->doc->createElement("smallPicture");
		$text = $this->doc->createTextNode($cd->getSmallPicture());
		$newSmallPicture->appendChild($text);
		$newCD->appendChild($newSmallPicture);
		
		$newAlbum = $this->doc->createElement("Album");
		$text = $this->doc->createTextNode($cd->getAlbum());
		$newAlbum->appendChild($text);
		$newCD->appendChild($newAlbum);

		$newSinger = $this->doc->createElement("Singer");
		$Singer = $cd->getSinger();
		$Name = $Singer['Name'];
		$Sex = $Singer['Sex'];
		$Area = $Singer['Area'];
		$newSingerName = $this->doc->createElement("Name");
		$text = $this->doc->createTextNode($Name);
		$newSingerName->appendChild($text);
		$newSingerSex = $this->doc->createElement("Sex");
		$text = $this->doc->createTextNode($Sex);
		$newSingerSex->appendChild($text);
		$newSingerArea = $this->doc->createElement("Area");
		$text = $this->doc->createTextNode($Area);
		$newSingerArea->appendChild($text);
		$newSinger->appendChild($newSingerName);
		$newSinger->appendChild($newSingerSex);
		$newSinger->appendChild($newSingerArea);
		$newCD->appendChild($newSinger);

		$newSong = $this->doc->createElement("Song");
		$Songs = $cd->getSongs();
		foreach ($Songs as $song) {
			$newItem = $this->doc->createElement("Item");
			$text = $this->doc->createTextNode($song);
			$newItem->appendChild($text);
			$newSong->appendChild($newItem);
		}
		$newCD->appendChild($newSong);

		$newLanguage = $this->doc->createElement("Language");
		$text = $this->doc->createTextNode($cd->getLanguage());
		$newLanguage->appendChild($text);
		$newCD->appendChild($newLanguage);

		$newPrice = $this->doc->createElement("Price");
		$text = $this->doc->createTextNode($cd->getPrice());
		$newPrice->appendChild($text);
		$newCD->appendChild($newPrice);

		$newPopularity = $this->doc->createElement("Popularity");
		$text = $this->doc->createTextNode($cd->getPopularity());
		$newPopularity->appendChild($text);
		$newCD->appendChild($newPopularity);
		
		$newStorage = $this->doc->createElement("Storage");
		$text = $this->doc->createTextNode($cd->getStorage());
		$newStorage->appendChild($text);
		$newCD->appendChild($newStorage);

		$newPublisher = $this->doc->createElement("Publisher");
		$text = $this->doc->createTextNode($cd->getPublisher());
		$newPublisher->appendChild($text);
		$newCD->appendChild($newPublisher);

		$newDealer = $this->doc->createElement("Dealer");
		$text = $this->doc->createTextNode($cd->getDealer());
		$newDealer->appendChild($text);
		$newCD->appendChild($newDealer);

		$newDescription = $this->doc->createElement("Description");
		$text = $this->doc->createTextNode($cd->getDescription());
		$newDescription->appendChild($text);
		$newCD->appendChild($newDescription);

		$root = $this->doc->getElementsByTagName("MusicProduct");
		$root->item(0)->appendChild($newCD);
		$this->doc->getElementsByTagName("MusicCount")->item(0)->nodeValue = $musicCount;
		$this->doc->save("../CD/cd.xml");
	}

	function modifyCD($cd) {
		/**
		 * 传入一个已存在的CD对象，将cd.xml文件中的对应CD子节点的内容覆盖。
		 */
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music) {
			$number = $Music->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($cd->getMusicNumber(), $number) == 0) {
				$Music->setAttribute("UploadDate", $cd->getUploadDate());
				$Music->getElementsByTagName("Album")->item(0)->childNodes->item(0)->nodeValue = $cd->getAlbum();
		$Music->getElementsByTagName("bigPicture")->item(0)->childNodes->item(0)->nodeValue = $cd->getBigPicture();
		$Music->getElementsByTagName("smallPicture")->item(0)->childNodes->item(0)->nodeValue = $cd->getSmallPicture();
		$Music->getElementsByTagName("Name")->item(0)->childNodes->item(0)->nodeValue = $cd->getSingerName();
		$Music->getElementsByTagName("Sex")->item(0)->childNodes->item(0)->nodeValue = $cd->getSingerSex();
		$Music->getElementsByTagName("Area")->item(0)->childNodes->item(0)->nodeValue = $cd->getSingerArea();

		$Songs = $Music->getElementsByTagName("Song");
		$iter = 0;
		$temp = $cd->getSongs();
		foreach ($Songs as $Song) {
			$Song->childNodes->item(0)->nodeValue = $temp[$iter];
			$iter = $iter +1;
		}
		$Music->getElementsByTagName("Language")->item(0)->childNodes->item(0)->nodeValue = $cd->getLanguage();
		$Music->getElementsByTagName("Price")->item(0)->childNodes->item(0)->nodeValue = $cd->getPrice();
		$Music->getElementsByTagName("Popularity")->item(0)->childNodes->item(0)->nodeValue = $cd->getPopularity();
		$Music->getElementsByTagName("Storage")->item(0)->childNodes->item(0)->nodeValue = $cd->getStorage();
		$Music->getElementsByTagName("Publisher")->item(0)->childNodes->item(0)->nodeValue = $cd->getPublisher();
		$Music->getElementsByTagName("Dealer")->item(0)->childNodes->item(0)->nodeValue = $cd->getDealer();
		$Music->getElementsByTagName("Description")->item(0)->childNodes->item(0)->nodeValue = $cd->getDescription();
		$this->doc->save("../CD/cd.xml");
		break;
			}
		}
		
	}

	function deleteCDByID($ID) {
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music) {
			$number = $Music->getElementsByTagName("MusicNumber")->item(0)->nodeValue;
			if (strcasecmp($ID, $number) == 0) {
				break;
			}
		}
		$this->doc->documentElement->removeChild($Music);
		if($this->doc->save("../CD/cd.xml"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function showAllCD()
	{
		$CDs=array();
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music) 
		{
			$CD=$this->makeCD($Music);
			array_push($CDs, $CD);
			
		}
		return $CDs;
	}
	
	function getCDByLanguage($language)
	{
		$CDs=array();
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music)
		{
			$Language = $Music->getElementsByTagName('Language')->item(0)->nodeValue;
			if (strcasecmp($language, $Language) == 0)
			{
				$CD=$this->makeCD($Music);
				array_push($CDs, $CD);
			}
		}
		return $CDs;
	}
	
	function getCDByArea($area)
	{
		$CDs=array();
		$Musics = $this->doc->getElementsByTagName("Music");
		foreach ($Musics as $Music)
		{
			$singerName = $this->getFirstChild($Music->getElementsByTagName("Singer")->item(0));
			$singerSex = $this->getNextSibling($singerName);
			$singerArea = $this->getNextSibling($singerSex);
			if (strcasecmp($singerArea->nodeValue, $area) == 0)
			{
				$CD=$this->makeCD($Music);
				array_push($CDs, $CD);
			}
		}
		return $CDs;
	}
	
}
?>