<?php
require("../../control/cd_control.php");
$musicNumber = $_GET['musicNumber'];
$CD = getCDByID($musicNumber);
?>
<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
 	<title>modify CD</title>
 	<style type="text/css">
		div#container{width:1000px}
		div#image {height:400px; width:400px; float:left;}
		div#content {height:400px; width:300px; float:left;}
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
			<form action="../admin/modify_success.php" method="post">		
			<p>album:<input type="text" name="album" value="<?php echo $CD->getAlbum(); ?>" /></p>
			<p>singerName:<input type="text" name="name" value="<?php echo $CD->getSingerName(); ?>" /></p>
			<p>singerSex:<input type="text" name="sex" value="<?php echo $CD->getSingerSex(); ?>" /></p>
			<p>singerArea:<input type="text" name="area" value="<?php echo $CD->getSingerArea(); ?>" /></p>
			<p>big picture:<input type="file" name="image_w" value="<?php echo $CD->getBigPicture(); ?>" /></p>
			<p>small picture:<input type="file" name="image_b" value="<?php echo $CD->getSmallPicture(); ?>"/></p>
			<p>language:<input type="text" name="language" value="<?php echo $CD->getLanguage(); ?>" /></p>
			<p>price:<input type="text" name="price" value="<?php echo $CD->getPrice(); ?>" /></p>
			<p>storage:<input type="text" name="storage" value="<?php echo $CD->getStorage(); ?>" /></p>
			<p>publisher:<input type="text" name="publisher" value="<?php echo $CD->getPublisher(); ?>" /></p>
			<p>dealer:<input type="text" name="dealer" value="<?php echo $CD->getDealer(); ?>" /></p>
			<p>description:<input type="text" name="description" value="<?php echo $CD->getDescription(); ?>" /></p>
			<p>popularity:<input type="text" name="popularity" value="<?php echo $CD->getPopularity();?>" /></p>
					
		</div>
		<div id="content">
			<p>songs:</p>
				<?php $count=1 ;foreach ($CD->getSongs() as $song): ?>
				<p>&emsp;<input type="text" name="song<?php echo $count.'"';$count++;?> value="<?php echo $song; ?>" /></p>
				<?php endforeach; ?>	
			<p><input type="hidden" name="songCount" value="<?php echo ($count-1)?>" /></p>
			<p><input type="hidden" name="uploadDate" value="<?php echo $CD->getUploadDate();?>" /></p>
			<p><input type="hidden" name="musiceNumber" value="<?php echo $CD->getMusicNumber();?>" /></p>
			<p><input type="submit" value="确认修改"/></p>	
			</form>		
		</div>
	</div>	
	</body>
</html>