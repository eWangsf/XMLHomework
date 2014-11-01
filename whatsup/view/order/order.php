<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
		<title>Order</title>
	</head>
	<body>
		<h2 align="center">生成订单</h2><br/>
		<form action="./order_success.php" method="post">
		收件人：<input type="text" name="RecipientName"/><br/><br/>
		收件地址：<input type="text" name="Address"/><br/><br/>
		邮编：<input type="text" name="Zip"/><br/><br/>
		收件人电话：<input type="text" name="RecipientPhone"/><br/><br/>
		备注：<input type="text" name="Remark"/><br/><br/>
		支付方式：<select name="PaymentMethod">
				  <option value="信用卡">信用卡</option>
				  <option value="网银">网银</option>
				  <option value="支付宝" selected="selected">支付宝</option> 
				  </select>
				  <br/><br/>
		<input type="submit" value="确认订单"/>
		</form>
	</body>
</html>  