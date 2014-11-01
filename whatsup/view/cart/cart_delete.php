<?php
require("../../control/cart_control.php");
require("../../control/cd_control.php");

$musicNumber = $_GET['musicNumber'];
deleteProductByMusicNumber($musicNumber);

$Products = showAllProduct();
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<body>
	<script>location='../cart/cart.php'</script>
</body>
</html>