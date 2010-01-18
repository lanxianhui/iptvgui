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
<link rel="stylesheet" type="text/css" media="all"
	href="calendar/calendar-system.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function submitOrderTotal(){
	var fromDate = jQuery("#x_fromDate").attr("value");
	var toDate = jQuery("#x_toDate").attr("value");
	if( fromDate == "" || toDate == "")
	{
		alert("请填写需要查询的账户时间段");
	}else{
		jQuery("#orderForm").submit();
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
<form id="orderForm" action="ordertotal.service" method="GET"><input
	type="hidden" name="pageindex" value="0" />
<dl>
	<dt><img src="images/content.jpg" /><span>我的订单</span></dt>
	<dt style="border-bottom: none; padding: 5px; height: 60px;">
	<table style="font-size: 12px;width:100%;">
		<tr>
			<td>开始时间：</td>
			<td><input type="text" value="" class="inputtext"
				id="x_fromDate" name="x_fromDate" readonly="readonly" />&nbsp;&nbsp;<img
				src="images/calendar.png" id="x_fromImg" name="x_fromImg" alt="选择日期"
				style="cursor: pointer; cursor: hand; float: none;"> <script
				type="text/javascript">
Calendar.setup({
	inputField : "x_fromDate", // ID of the input field
	ifFormat : "%Y-%m-%d", // the date format
	button : "x_fromImg" // ID of the button
});
</script></td>
			<td>结束时间：</td>
			<td><input type="text" value="" class="inputtext"
				readonly="readonly" id="x_toDate" name="x_toDate" />&nbsp;&nbsp;<img
				src="images/calendar.png" id="x_toImg" name="x_toImg" alt="选择日期"
				style="cursor: pointer; cursor: hand; float: none;"> <script
				type="text/javascript">
Calendar.setup({
	inputField : "x_toDate", // ID of the input field
	ifFormat : "%Y-%m-%d", // the date format
	button : "x_toImg" // ID of the button
});
</script></td>
		</tr>
		<tr>
			<td>填写卡号：</td>
			<td><input type="text" value="" class="inputtext" name="x_Card"
				id="x_Card" /></td>
			<td><input type="button" onclick="submitOrderTotal();return false;" value="账务查询"/></td>
			<td></td>
		</tr>
	</table>
	</dt>
	<dd>
	<table id="listview">
		<thead>
			<tr>
				<th>订单号</th>
				<th>充值卡号</th>
				<th>充值金额</th>
				<th>订单状态</th>
				<th>充值时间</th>
			</tr>
		</thead>
		<tbody>
			<c:forEach var="item" items="${orderlist}">
				<tr>
					<td>${item.lineNumber}</td>
					<td>${item.cardNumber}</td>
					<td><strong style="color: red">￥${item.price}</strong></td>
					<td><strong style="color: blue">${item.statusString}</strong></td>
					<td><strong>${item.createTime}</strong></td>
				</tr>
			</c:forEach>
		</tbody>
		<tfoot>
			<tr>

			</tr>
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