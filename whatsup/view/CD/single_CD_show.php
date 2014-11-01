<?php
require("..\..\control\cd_control.php");
$musicNumber = $_GET['musicNumber'];
$CD = getCDByID($musicNumber);
?>
<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
 	<title>single CD Show</title>
 	<style type="text/css">
		div#container{width:1000px}
		div#image {height:400px; width:400px; float:left;}
		div#content {height:400px; width:500px; float:left;}
		div#description {clear:both; text-align:center;}
		div#cart{}
	</style>
</head>
	<body>
	<div id="container">
		<div id="image">
			<img src="<?php echo $CD->getBigPicture();?>"/>
		</div>
		
		<div id="content">
			<li>album:<?php echo $CD->getAlbum(); ?></li>
			<li>singer:<?php echo $CD->getSingerName().";".$CD->getSingerSex().";".$CD->getSingerArea(); ?></li>
			<li>language:<?php echo $CD->getLanguage(); ?></li>
			<li>songs:</li>
				<?php foreach ($CD->getSongs() as $song): ?>
				&nbsp;&nbsp;<?php echo $song."</br>"; ?>
				<?php endforeach; ?>
			<li>price:<?php echo $CD->getPrice(); ?></li>
			<li>storage:<?php echo $CD->getStorage() ?></li>
			<li>publisher:<?php echo $CD->getPublisher() ?></li>
			<li>dealer:<?php echo $CD->getDealer() ?></li>
		</div>
		
		<div id="description">
			<li>description:<?php echo $CD->getDescription() ?></li>
		</div>
		
		<div id="cart">
			<form action="../cart/cart_add.php"  method="post">
			<p><input type="hidden" name="musicNumber" value="<?php echo $CD->getMusicNumber()?>"/></p> 
			<p>输入购买数量：<input type="text" name="amount"/></p>
			<p><input type="submit" value="加入购物车"/></p>
			</form>
		</div>
	</div>						
</body>
</html>