<?php
require("../../control/cart_control.php");
require("../../control/cd_control.php");
$Products = showAllProduct();
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
		<title>图书交易平台-购物车</title>
		<style type="text/css">
		div#container{width:975px;}
		div#hr{width:1100px;}
		div#header{height:50px; width:135px; float:left;}
		div#headerimage{height:50px; width:300px; float:left;}
		div#image {height:180px; width:300px; float:left;}
		div#content {height:180px; width:135px; float:left; align:"right";}
		div#footer {clear:both; text-align:right;}
	</style>
</head>
	<body>
	<div id="container">
		<div id="headerimage">
			<p align="center">图片</p>
		</div>
		<div id="header">
			<p align="center">专辑名</p>			
		</div>
		
		<div id="header">
			<p align="center">价格</p>
		</div>
		
		<div id="header">
			<p align="center">数量</p>
		</div>
			
		<div id="header">
			<p align="center">总价</p>
		</div>
		
		<div id="header">
			<p align="center">操作</p>
		</div>
		<?php $totalSum = 0;foreach ($Products as $Product):?>
		<?php $productSum = $Product->getPrice() * $Product->getAmount();
		$totalSum += $productSum;?>		

		<div id="image" align="center">
			<?php $name = $Product->getAlbum();$cd = getCDByName($name);?>
		<img  src="<?php echo $cd->getSmallPicture();?>">
		</div>
		<div id="content">
			<p align="center"><?php echo $name?></p>			
		</div>
		
		<div id="content">
			<p align="center"><?php echo $Product->getPrice();?></p>
		</div>
		
		<div id="content">
			<p align="center"><?php echo $Product->getAmount();?></p>
		</div>
			
		<div id="content">
			<p align="center"><?php echo $productSum;?>
		</div>
		
		<div id="content">
			<p align="center"><a href="./cart_delete.php?musicNumber=<?php echo $Product->getMusicNumber();?>">删除</a></p>
		</div>
		<?php endforeach;?>
		<div id="footer">
			小计：<?php echo $totalSum;?>
		</div>
		<div id="image">
			<form action="../order/order.php"  method="post">
			<p align="center"><input type="submit" value="提交订单"/></p>
			</form>
		</div>
	</div>
	
	</body>
</html>
