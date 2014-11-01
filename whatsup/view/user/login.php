<?php 
$loginResult = $_GET['loginMsg'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>

<body>
<?php if($loginResult):?>
<form action="./login_success.php"  method="post">
 <p><h2 align="center">你好，请登录</h2></p>
  <p align="center"> 账号：<input type="text" name="userName"/></p>
  <p align="center">密码：<input type="password" name="userPassword"/></p>
 <p align="center">账号或密码错误!</p>
 <p align="center"><input type="submit" value="登录"/></p>
</form>
<?php else:?>
<form action="./login_success.php"  method="post">
<p><h2 align="center">你好，请登录</h2></p>
 <p align="center"> 账号：<input type="text" name="userName"/></p>
 <p align="center"> 密码：<input type="password" name="userPassword"/></p>
 <br/>
  <p align="center"><input type="submit" value="登录"/></p>
</form>
<?php endif;?>
</body>
</html>