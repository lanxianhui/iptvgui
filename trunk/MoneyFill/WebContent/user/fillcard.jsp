<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>卡号充值</title>
<link rel="stylesheet" href="css/site.css" type="text/css">
</head>
<body>

<div id="header">
Header
</div>
<div id="menu">
<dl>
	<dt></dt>
	<dd>
	<ul>
		<li><a href="userbind.service">绑定手机</a></li>
		<li><a href="usercard.service">卡号充值</a></li>
		<li><a href="userprice.service">充值记录</a></li>
		<li><a href="userorders.service">我的订单</a></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<form:form method="POST" action="addorder.service" commandName="orderUser">
	<table>
		<tr><td>请填写您的充值信息：</td></tr>
		<tr><td>充值卡号：</td>
		<td><form:input path="cardNumber"/></td>
		<td><form:errors path="cardNumber"/></td></tr>
		<tr><td>充值金额：</td>
		<td><form:input path="price"/></td>
		<td><form:errors path="price"/></td></tr>
		<tr><td></td><td>
		<input type="submit" value="提交信息"/>
		</td><td></td></tr>
	</table>
	</form:form>
</div>
<div id="footer">
Footer
</div>
</body>
</html>