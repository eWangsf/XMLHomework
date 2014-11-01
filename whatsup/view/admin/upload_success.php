<?php
require '../../control/admin_control.php';
header('Content-Type: text/html; charset=UTF-8');
$cdArray['album'] = $_POST['album'];
$cdArray['name'] = $_POST['name'];
$cdArray['sex'] = $_POST['sex'];
$cdArray['area'] = $_POST['area'];
$cdArray['language'] = $_POST['language'];
$cdArray['price'] = $_POST['price'];
$cdArray['popularity'] = $_POST['popularity'];
$cdArray['storage'] = $_POST['storage'];
$cdArray['publisher'] = $_POST['publisher'];
$cdArray['dealer'] = $_POST['dealer'];
$cdArray['description'] = $_POST['description'];
$cdArray['image_w'] = "../CD_img/".$_POST['image_w'];
$cdArray['image_b'] = "../CD_img/".$_POST['image_b'];
$songNumber = $_POST['songNumber'];
$songArray = array();
for($i=1;$i<=$songNumber;$i++)
{
	array_push($songArray, $_POST['song'.$i]);
}
uploadCD($cdArray,$songArray);
echo '<h2 align="center">上传成功</h2>';
echo '<p align="center"><a href="../admin/adminHome.php">返回主页</a></p>';
echo '<p align="center"><a href="./upload_CD.php">继续上传</a></p>';
?>