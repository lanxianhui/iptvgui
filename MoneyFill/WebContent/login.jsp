<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<form:form method="POST" action="loginuser" commandName="loginUser">
<table>
	<tr>
		<td>用户名：</td>
		<td><form:input path="username"/></td>
		<td><form:errors path="username"/></td>
	</tr>
	<tr>
		<td>用户名：</td>
		<td><form:password path="password"/></td>
		<td><form:errors path="password"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="登陆"/></td>
	</tr>
</table>
</form:form>
</body>
</html>