<?php 
require("../../control/cd_control.php");
$area = $_GET['area'];
$CDS = getCDByArea($area);
?>
<!DOCTYPE html>
 	<head>
 		<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
 		<title>CD Shows</title>
	</head>
	<body>
	<ul style="width:1000px;">
	<?php foreach ($CDS as $CD): ?>
			<div style="width:200px;float:left">
			<font size="2">
				<p align="center" style="line-height: 50%"><a <?php echo 'href="./single_CD_show.php?musicNumber='.$CD->getMusicNumber().'"'?>><img border="0" src="<?php echo $CD->getSmallPicture();?>"/></a></p>
				<p align="center" style="line-height: 50%"><?php echo $CD->getAlbum(); ?></p>
				<p align="center" style="line-height: 50%"><?php echo $CD->getSingerName();?></p>
				<p align="center" style="line-height: 50%"><?php echo $CD->getPrice();?></p>
				<p align="center" style="line-height: 50%">流行程度：<?php echo $CD->getPopularity();?></p>
			</font>
			</div>
	<?php endforeach;?>	
	</ul>

		

	</body>
</html>