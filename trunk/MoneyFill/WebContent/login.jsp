<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>用户登陆</title>
<link rel="stylesheet" href="css/site.css" type="text/css">
</head>
<body>
<div id="header">
<img src="images/b_logo.gif"></img>
<div id="title">
演示系统管理后台
</div>
<img id="bar" src="images/banner.jpg"></img>
</div>
<div id="login">
<div id="loginBg">
<form:form method="POST" action="loginuser.service" commandName="loginUser">
<table>
	<tr><td colspan="3" style="text-align:center;"><img src="images/msn_logo.jpg" id="tlogo"></img><div id="ttitle">重庆市泛易科技有限公司登陆平台：<br/><hr /></div></td></tr>
	<tr>
		<td class="labeltd">登陆帐号：</td>
		<td><form:input path="username"/></td>
		<td class="error"><form:errors path="username"/></td>
	</tr>
	<tr>
		<td class="labeltd">登陆密码：</td>
		<td><form:password path="password"/></td>
		<td class="error" style="width:200px;"><form:errors path="password"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" id="sbutton"  value="登陆"/>&nbsp;&nbsp;
		<input type="reset" id="rbutton"  value="重置"/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2" class="error">${loginErrorMessage}</td>
	</tr>
</table>
</form:form>
</div>
</div>
<div id="footer">
<img src="images/b_logo.gif"></img>
<div id="copyright">

电话：023-11111111&nbsp;&nbsp;&nbsp;地址：重庆市观音桥红鼎国际3404<br/>
重庆市泛易科技有限公司——深圳泛易网络科技有限公司重庆分公司. All right reserved. From 2010 To 2015.<br/>
</div>
</div>
</body>
</html>