<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>用户后台</title>
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
Content
</div>
<div id="footer">
Footer
</div>
</body>
</html>