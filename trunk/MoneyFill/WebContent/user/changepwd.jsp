<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>修改口令</title>
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
		<li><a href="userpwd.service">修改口令</a></li>
		<li><a href="usercard.service">卡号充值</a></li>
		<li><a href="userprice.service">充值记录</a></li>
		<li><a href="userorders.service">我的订单</a></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<dl>
	<dt></dt>
	<dd>
	<form:form method="POST" action="changepwd.service" commandName="userPwd">
	<table>
		<tr><td>请填写口令信息：</td></tr>
		<tr><td>输入原口令：</td>
		<td><form:input path="oldPassword"/></td>
		<td><form:errors path="oldPassword"/></td></tr>
		<tr><td>输入新口令：</td>
		<td><form:input path="newPassword"/></td>
		<td><form:errors path="newPassword"/></td></tr>
		<tr><td></td><td>
		<input type="submit" value="提交信息"/>
		</td><td></td></tr>
	</table>
	</form:form>
	</dd>
</dl>
</div>
<div id="footer">
Footer
</div>
</body>
</html>