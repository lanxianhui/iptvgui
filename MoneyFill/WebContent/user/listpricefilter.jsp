<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>用户后台</title>
<link rel="stylesheet" href="css/site.css" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function submitFilterForm(){
	var selectValue = jQuery("#cardSelect").attr("value");
	var numberInput = jQuery("#cardNumber").attr("value");
	if( Number(selectValue) == -1 && numberInput == "")
	{
		alert("请录入卡号或者选择卡号！");
	}else{
		jQuery("#filterForm").submit();
	}
}
</script>
</head>
<body>
<div id="header"><img src="images/b_logo.gif"></img>
<div id="title">演示系统管理后台</div>
<img id="bar" src="images/banner.jpg"></img></div>
<div id="menu">
<dl>
	<dt>选择您的操作</dt>
	<dd>
	<ul>
		<li><a href="userbind.service">绑定手机</a><img
			src="images/li_48.jpg" /></li>
		<li><a href="userpwd.service">修改口令</a><img src="images/li_48.jpg" /></li>
		<li><a href="usercard.service">卡号充值</a><img
			src="images/li_48.jpg" /></li>
		<li><a href="userprice.service?pageindex=0">绑定记录</a><img
			src="images/li_48.jpg" /></li>
		<li><a href="userorders.service?pageindex=0">我的订单</a><img
			src="images/li_48.jpg" /></li>
		<li><a href="logout.service">我要注销</a><img src="images/li_48.jpg" /></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<form id="filterForm" action="filtercard.service"
	method="POST">
<dl>
	<dt><img src="images/content.jpg" /><span>绑定记录</span>
	<span style="float:right;font-size:12px;">
		选择卡号：
		<input type="hidden"
		value="${param.pageindex}" name="pageindex" /> <select
		name="cardSelect" id="cardSelect">
		<option value="-1">未选择</option>
		<c:forEach var="item" items="${cardselect}">
			<c:choose>
				<c:when test="${item == selectCardNumber}">
					<option value="${item}" selected="selected">${item}</option>
				</c:when>
				<c:otherwise>
					<option value="${item}">${item}</option>
				</c:otherwise>
			</c:choose>
		</c:forEach>
	</select>&nbsp;&nbsp;录入卡号：<input type="text"
		name="cardNumber" id="cardNumber" class="inputtext" />&nbsp;&nbsp;<input type="button"
		onclick="submitFilterForm();" value="查询" />
	</span>
	</dt>
	<dd>
	<table id="listview">
		<thead>
			<tr>
				<th>绑定卡号</th>
				<th>手机号</th>
				<th>绑定时间</th>
			</tr>
		</thead>
		<tbody>
			<c:forEach var="item" items="${cardlist}">
				<tr>
					<td><strong style="color: green">${item.cardNumber}</strong></td>
					<td><strong style="color: blue">${item.mobileNumber}</strong></td>
					<td>${item.createTime}</td>
				</tr>
			</c:forEach>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	</dd>
</dl>
</form>
</div>
<div id="footer"><img src="images/b_logo.gif"></img>
<div id="copyright">
电话：023-11111111&nbsp;&nbsp;&nbsp;地址：重庆市观音桥红鼎国际3404<br />
重庆市泛易科技有限公司——深圳泛易网络科技有限公司重庆分公司. All right reserved. From 2010 To 2015.<br />
</div>
</div>
</body>
</html>