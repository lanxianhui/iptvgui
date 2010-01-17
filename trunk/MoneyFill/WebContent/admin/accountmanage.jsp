<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>帐号管理</title>
<link rel="stylesheet" href="css/site.css" type="text/css">
<script type="text/javascript">
function deluser(userid){
	var result = window.confirm("点击该操作不仅仅会删除账户，同样会删除账户相关的所有信息，请谨慎操作！");
	if( result == true )
	{
		window.location = "deluser.service?id=" + userid;
	}
}
</script>
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
		<li><a href="">账务查询</a><img src="images/li_48.jpg"/></li>
		<li><a href="">订单管理</a><img src="images/li_48.jpg"/></li>
		<li><a href="logout.service">我要注销</a><img src="images/li_48.jpg"/></li>
	</ul>
	</dd>
</dl>
</div>
<div id="content">
<dl>
	<dt><img src="images/content.jpg"/><span>帐号管理</span><a href="adduserform.service" class="link" style="float:right;">添加帐号</a></dt>
	<dd>
	<table id="listview">
		<thead>
			<tr>
				<th>帐号名</th>
				<th>帐号类型</th>
				<th>选择操作</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<c:forEach var="item" items="${userlist}">
				<tr>
					<td>${item.username}</td>
					<td>${item.userSortString}</td>
					<td><a href="#" onclick="deluser(${item.id});return false;" class="link">删除该账户</a></td>
					<td><a href="changepwdform.service?id=${item.id}" class="link">修改口令</a></td>
				</tr>
			</c:forEach>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
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