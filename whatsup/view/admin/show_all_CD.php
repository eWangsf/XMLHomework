<?php 
require("../../control/cd_control.php");
$CDS = showAllCD();
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
				<p align="center" style="line-height: 50%" ><img src="<?php echo $CD->getSmallPicture();?>"/></p>
				<p align="center" style="line-height: 50%"><?php echo $CD->getAlbum(); ?>
				<p align="center" style="line-height: 50%"><?php echo $CD->getSingerName();?></p>
				<p align="center" style="line-height: 50%"><?php echo $CD->getLanguage(); ?></p>
				<p align="center" style="line-height: 50%"><a <?php echo 'href="./modify_CD.php?musicNumber='.$CD->getMusicNumber().'"'?>>修改</a></p>
				<p align="center" style="line-height: 50%"><a <?php echo 'href="./delete_CD.php?musicNumber='.$CD->getMusicNumber().'"'?>>删除</a></p>
			</font>
			</div>
	<?php endforeach;?>	
	</ul>

		

	</body>
</html>