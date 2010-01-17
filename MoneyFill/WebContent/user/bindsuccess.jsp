<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>充值成功</title>
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
		<li><a href="userbind.service">绑定手机</a><img src="images/li_48.jpg"/></li>
		<li><a href="userpwd.service">修改口令</a><img src="images/li_48.jpg"/></li>
		<li><a href="usercard.service">卡号充值</a><img src="images/li_48.jpg"/></li>
		<li><a href="userprice.service?pageindex=0">绑定记录</a><img src="images/li_48.jpg"/></li>
		<li><a href="userorders.service?pageindex=0">我的订单</a><img src="images/li_48.jpg"/></li>
		<li><a href="logout.service">我要注销</a><img src="images/li_48.jpg"/></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<dl>
	<dt><img src="images/content.jpg"/><span>绑定成功</span></dt>
	<dd>
	<img src="images/success.png" style="float:left;width:120px;height:120px;margin-right:30px;"/>
	<p id="msgsuccess">
	您的绑定信息已经成功提交<br/>
	本次输入手机号为：<strong style="color:green">${cardSuccess.mobileNumber}</strong><br/>
	绑定卡号为：<strong style="color:green">${cardSuccess.cardNumber}</strong><br/>
	点击&nbsp;<a href="userprice.service?pageindex=0">绑定记录</a>&nbsp;可以查询绑定信息
	</p>
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