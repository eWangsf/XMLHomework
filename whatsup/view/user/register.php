<?php 
$msg = $_GET['msg'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<script type="text/javascript">
function validate_email(field,alerttxt)
{
with (field)
{
apos=value.indexOf("@")
dotpos=value.lastIndexOf(".")
if (apos<1||dotpos-apos<2) 
  {alert(alerttxt);return false}
else {return true}
}
}

function validate_form(thisform)
{
with (thisform)
{
if (validate_email(email,"Not a valid e-mail address!")==false)
  {email.focus();return false}
}
}
</script>
</head>

<body>
<?php if($msg):?>
<h2 align="center"><?php echo $msg;?>,请重新注册</h2>
<?php else:?>
<h2 align="center">请注册</h2><br/>
<?php endif;?>
<form action="./register_success.php" onsubmit="return validate_form(this);" method="post">
昵称：<input type="text" name="userName"/><br/>
密码：<input type="password" name="userPassword"/><br/>
Email: <input type="text" name="email" size="30"><br/>
真实姓名：<input type="text" name="name"/><br/>
性别：<br/>
<input type="radio" value="男" name="sex">男</input><br/>
<input type="radio" value="女" name="sex">女</input><br/>
生日:<input type="text" name="birthday"/>请以****-**-**的格式输入<br/>
手机：<input type="text" name="phone"/>请输入11位号码<br/>
地址：<input type="text" name="address"/><br/>
邮编：<input type="text" name="zip"/>请输入6位邮编<br/>
<input type="submit" value="立即注册"/>
</form>
</body>
</html>