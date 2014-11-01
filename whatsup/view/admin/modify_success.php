<?php
require '../../control/admin_control.php';
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
$cdArray['publisher'] = $_POST['publisher'];
$cdArray['musiceNumber'] = $_POST['musiceNumber'];
$cdArray['uploadDate'] = $_POST['uploadDate'];
$cdArray['image_w'] = "../CD_img/".$_POST['image_w'];
$cdArray['image_b'] = "../CD_img/".$_POST['image_b'];
$songArray = array();
$songCount = $_POST['songCount'];
for($i=1;$i<=$songCount;$i++)
{
	array_push($songArray, $_POST['song'.($i)]);
}

modify_CD($cdArray, $songArray);
echo '<h2 align="center">修改成功</h2><a  href="../admin/show_all_CD.php" align="center" >继续修改</a>';
?>