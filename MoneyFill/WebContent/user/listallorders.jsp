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
<dl>
	<dt><img src="images/content.jpg" /><span>账务查询</span> <span
		style="font-size: 12px;">开始时间： <input type="text" value=""
		class="inputtext" id="x_fromDate" name="x_fromDate"
		readonly="readonly" />&nbsp;&nbsp;<img src="images/calendar.png"
		id="x_fromImg" name="x_fromImg" alt="选择日期"
		style="cursor: pointer; cursor: hand; float: none;"> <script
		type="text/javascript">
Calendar.setup({
	inputField : "x_fromDate", // ID of the input field
	ifFormat : "%Y-%m-%d", // the date format
	button : "x_fromImg" // ID of the button
});
</script> &nbsp;&nbsp; 结束时间： <input type="text" value="" class="inputtext"
		readonly="readonly" id="x_toDate" name="x_toDate" />&nbsp;&nbsp;<img
		src="images/calendar.png" id="x_toImg" name="x_toImg" alt="选择日期"
		style="cursor: pointer; cursor: hand; float: none;"> <script
		type="text/javascript">
Calendar.setup({
	inputField : "x_toDate", // ID of the input field
	ifFormat : "%Y-%m-%d", // the date format
	button : "x_toImg" // ID of the button
});
</script> <a href="#" onclick="submitOrderTotal();return false;" class="link">账务查询</a>
	</span></dt>
	<dd>
	<table id="tableform">
		<tr>
			<td><span class="link">账务详细信息</span></td>
			<td></td>
		</tr>
		<c:forEach items="${viewTotal}" var="item">
			<tr>
				<td><c:choose>
					<c:when test="${item.key == '处理完成'}">
						<strong style="color:green;">${item.key}</strong>
				</c:when>
				<c:when test="${item.key == '新订单'}">
						<strong style="color:red;">${item.key}</strong>
				</c:when>
					<c:otherwise>
					<strong>${item.key}</strong>
				</c:otherwise>
				</c:choose>
				</td>
				<td><c:choose>
					<c:when test="${item.value == null}">
						￥0.00
					</c:when>
					<c:otherwise>
					<c:choose>
					<c:when test="${item.key == '处理完成'}">
						<strong style="color:green;">￥${item.value}</strong>
				</c:when>
				<c:when test="${item.key == '新订单'}">
						<strong style="color:red;">￥${item.value}</strong>
				</c:when>
					<c:otherwise>
					<strong>￥${item.value}</strong>
				</c:otherwise>
				</c:choose>
				</c:otherwise>
				</c:choose></td>
			</tr>
		</c:forEach>
	</table>
	</dd>
</dl>
</div>
<div id="footer"><img src="images/b_logo.gif"></img>
<div id="copyright">
电话：023-11111111&nbsp;&nbsp;&nbsp;地址：重庆市观音桥红鼎国际3404<br />
重庆市泛易科技有限公司——深圳泛易网络科技有限公司重庆分公司. All right reserved. From 2010 To 2015.<br />
</div>
</div>
</body>
</html>