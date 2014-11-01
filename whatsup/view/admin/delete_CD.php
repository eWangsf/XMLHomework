<?php
require("../../control/cd_control.php");
$musicNumber = $_GET['musicNumber'];
$result = deleteCDByID($musicNumber);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>删除CD</title>
</head>
<body>
	<?php if($result):?>
	<h2 align="center">删除CD成功</h2>
	<?php else:?>
	<h2 align="center">删除CD失败，请稍后再试</h2>
	<?php endif;?>
	<p align="center"><a href="./show_all_CD.php">返回修改</a></p>
</body>
</html>