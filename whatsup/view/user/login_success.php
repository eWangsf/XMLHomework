<?php
require("..\..\control\user_control.php");
$userName=$_POST['userName'];
$userPassword=$_POST['userPassword'];
$result = login($userName, $userPassword);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>用户登录</title>
</head>
<body>
	<?php if($result):?>	
	<script>location='../user/user_home.php?userName=<?php echo $userName ?>';</script>
	<?php else:?>
	<script>location='./login.php?loginMsg="登录失败"';</script>
	<?php endif;?>
</body>
</html>