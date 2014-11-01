<?php $songNumber = $_POST['songNumber'];?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>

<body>
<h2 align="center">上传CD</h2><br/>
<?php if($songNumber):?>
<form action="./upload_success.php"  method="post">
专辑名：<input type="text" name="album"/><br/>

<p>大图:<input type="file" name="image_w"  /></p>
<p>小图:<input type="file" name="image_b" /></p>
歌手：</br>
  &nbsp;姓名：<input type="text" name="name"/><br/>
  &nbsp;性别：<input type="text" name="sex"/><br/>
  &nbsp;地区：</br>
  &nbsp;&nbsp;<input type="radio" value="大陆" name="area">大陆</input><br/>
  &nbsp;&nbsp;<input type="radio" value="港台" name="area">港台</input><br/>
  &nbsp;&nbsp;<input type="radio" value="日韩" name="area">日韩</input><br/>
  &nbsp;&nbsp;<input type="radio" value="欧美" name="area">欧美</input><br/><br/>
    
   
语言：</br>
   &nbsp;<input type="radio" value="华语" name="language">华语</input><br/>
   &nbsp;<input type="radio" value="粤语" name="language">粤语</input><br/>
   &nbsp;<input type="radio" value="日语" name="language">日语</input><br/>
   &nbsp;<input type="radio" value="韩语" name="language">韩语</input><br/>
   &nbsp;<input type="radio" value="英语" name="language">英语</input><br/><br/>
 
歌曲：</br>
<?php for($i=1;$i<=$songNumber;$i++):?>
&nbsp;歌曲<?php echo $i;?>：<input type="text" name="song<?php echo $i;?>"/><br/>
<?php endfor;?>
<br/>
价格：<input type="text" name="price"/><br/>

欢迎程度：<input type="text" name="popularity"/><br/>
 
库存：<input type="text" name="storage"/><br/>
 
出版商：<input type="text" name="publisher"/><br/>
 
出版公司：<input type="text" name="dealer"/><br/>
描述：<input type="text"  name="description"/><br/>
<input type="hidden" name="songNumber" value=<?php echo $songNumber?>/>
<input type="submit" value="上传"/>
</form>
<?php else:?>
<form action="../admin/upload_CD.php" method="post">
<p align="center">专辑歌曲数：<input type="text" name="songNumber"/></p>
<P align="center"><input type="submit" value="开始上传"/></P>
</form>
<?php endif;?>
</body>
</html>