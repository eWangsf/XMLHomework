<?php
require("../../control/user_control.php");
$userName=$_POST['userName'];
$userPassword=$_POST['userPassword'];
$Email=$_POST['email'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$birthday=$_POST['birthday'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$zip=$_POST['zip'];

$result = register($userName,$userPassword,$Email,$name,$sex,$birthday,$phone,$address,$zip);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>用户注册</title>
</head>
<body>
	<?php if($result):?>
	<script>location='../user/user_home.php?userName=<?php echo $userName?>';</script>
	<?php else:?>
	<script>location='../user/register.php?msg="注册失败"';</script>
	<?php endif;?>
</body>
</html>