<?php 
$userName = $_GET['userName'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>CD交易平台</title>
</head>


<style type="text/css">

*{margin:0;padding:0;border:0;}
body {
        font-size:12px;
}
#nav {
  line-height: 24px;  list-style-type: none; background:#666;   width:160px;
}

#nav a {
 display: block; width: 160px; text-align:center;
}

#nav a:link  {
 color:#666; text-decoration:none;
}
#nav a:visited  {
 color:#666;text-decoration:none;
}
#nav a:hover  {
 color:#FFF;text-decoration:none;font-weight:bold;
}

#nav li {
 /*float: left*/; width: 160px; background:#CCC;
}
#nav li a:hover{
 background:#999;
}
#nav li ul {
 line-height: 27px;  list-style-type: none;text-align:left;
 left: -999em; width: 160px; position: absolute; 
}
#nav li ul li{
 float: left; width: 160px;
 background: #F6F6F6; 
}

#nav li ul a{
 display: block; width: 160px;w\idth:56px;text-align:left;padding-left:24px;
}

#nav li ul a:link  {
 color:#666; text-decoration:none;
}
#nav li ul a:visited  {
 color:#666;text-decoration:none;
}
#nav li ul a:hover  {
 color:#F3F3F3;text-decoration:none;font-weight:normal;
 background:#C00;
}

#nav li:hover ul {
 left: auto;
}
#nav li.sfhover ul {
 left: auto;position:static;
}
#mrc {
 clear: left; 
}

</style>
<script type=text/javascript>
function menuFix() {
 var sfEls = document.getElementById("nav").getElementsByTagName("li");
 for (var i=0; i<sfEls.length; i++) {
  sfEls[i].onmouseover=function() {
  this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  sfEls[i].onMouseDown=function() {
  this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  sfEls[i].onMouseUp=function() {
  this.className+=(this.className.length>0? " ": "") + "sfhover";
  }
  sfEls[i].onmouseout=function() {
  this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"), 

"");
  }
 }
}
window.onload=menuFix;
</script>




<body>
<table width="1350" height="1000"border="0">

<tr heiht="100">
  <td colspan="2" style="background-color:#99bbbb;">
     <table>
     <tr height="100">
        <td width="1200">
             <h1 align="center">CD销售网站</h1>
        </td>
        <td width="100">
        	 <?php if($userName):?>
        	 <p align="center"><?php echo '您好,'.$userName.'!'?></p>
        	 <p align="center"><a href="./user_home.php">退出登录</a>
        	 <p align="center"><a href="../cart/cart.php" target="body">购物车</a>
        	 <?php else:?>
             <p align="center"><a href="./register.php" target="_top">注册</a></p>
             <p align="center"><a href="./login.php" target="_top">登录</a></p>
             <p align="center"><a href="./login.php" target="_top">购物车</a></p>
             <?php endif;?>
        </td>
     </tr>
     <tr height="50">
     	<td width="100">
     		<a align="center" href="./user_home.php?userName=<?php echo $userName ?>" style="text-decoration:none">网站首页</a>
     </table>
  </td>
</tr>

<tr valign="top" height="870">
   <td style="background-color:#ffff99;width:150px;text-align:top;">
    <ul id="nav">
     <li><p align="center">按地区</p>
         <ul>
            <li><a href="../CD/show_by_area.php?area=大陆" target="body">大陆</a></li>
            <li><a href="../CD/show_by_area.php?area=港台" target="body">港台</a></li>
            <li><a href="../CD/show_by_area.php?area=日韩" target="body">日韩</a></li>
            <li><a href="../CD/show_by_area.php?area=欧美" target="body">欧美</a></li>
         </ul>
     </li>
     <li><p align="center">按语言</p>
         <ul>
           <li><a href="../CD/show_by_language.php?language=华语" target="body">华语</a></li>
           <li><a href="../CD/show_by_language.php?language=粤语" target="body">粤语</a></li>
           <li><a href="../CD/show_by_language.php?language=日语" target="body">日语</a></li>
           <li><a href="../CD/show_by_language.php?language=韩语" target="body">韩语</a></li>
           <li><a href="../CD/show_by_language.php?language=英语" target="body">英语</a></li>
        </ul>
     </li>
    </ul>
   </td>
   <td style="background-color:#FFFFFF;height:200px;width:1350px;text-align:top;">
         <iframe src="../CD/show_all_CD.php?userName="<?php echo $userName;?> width="1000px" height="1000" name="body"></iframe>
   </td>
</tr>

<tr height="30">
     <td colspan="2" style="background-color:#99bbbb;text-align:center;">
         Copyright XML小组</td>
</tr>

</table>
</body>
</html>
