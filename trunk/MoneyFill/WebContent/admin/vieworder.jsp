<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>订单详情</title>
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
<div id="menu">
<dl>
	<dt>选择您的操作</dt>
	<dd>
	<ul>
		<li><a href="listuser.service?pageindex=0">帐号管理</a><img src="images/li_48.jpg"/></li>
		<li><a href="listorders.service?pageindex=0">订单账务</a><img src="images/li_48.jpg" /></li>
		<li><a href="logout.service">我要注销</a><img src="images/li_48.jpg" /></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<dl>
	<dt><img src="images/content.jpg"/><span>订单详情</span></dt>
	<dd>
	<form:form method="POST" action="modifystatus.service" commandName="statusForm">
		<input type="hidden" value="${viewOrder.id}" id="id" name="id"/>
		<table id="tableform">
			<tr>
				<td class="labeltd">订单号：</td>
				<td><strong>${viewOrder.lineNumber}</strong></td>
				<td class="error"></td>
			</tr>
			<tr>
				<td class="labeltd">充值卡号：</td>
				<td><strong>${viewOrder.cardNumber}</strong></td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="labeltd">充值金额：</td>
				<td><strong style="color:red">￥${viewOrder.price}</strong></td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="labeltd">订单状态：</td>
				<td><strong style="color:blue">${viewOrder.statusString}</strong></td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="labeltd">创建时间：</td>
				<td>${viewOrder.createTime}</td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="labeltd">下定帐户：</td>
				<td>${viewOrder.username}</td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="labeltd">选择状态：</td>
				<td>
				<form:select path="status">
					<form:option value="PRCESS_ORDER">正在处理</form:option>
					<form:option value="ACCEPT_ORDER">已经接受</form:option>
					<form:option value="MOVE_SEND">等待移动响应</form:option>
					<form:option value="FINISH">处理完成</form:option>
				</form:select>
				</td>
				<td class="error" style="width: 200px;"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" id="sbutton" value="处理订单" />&nbsp;&nbsp;
				<input type="reset" id="rbutton" value="重置" /></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" class="error">${createUserErrorMessage}</td>
			</tr>
		</table>
	</form:form>
	</dd>
</dl>
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