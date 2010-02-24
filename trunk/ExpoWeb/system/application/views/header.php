<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<base href="<?php echo base_url(); ?>"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHANGHAI CHINA EXPO主页</title>
<link href="css/site.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<!--站点头部-->
<div id="header">
<ul id="h_u_link">
<li><a href="">收藏本站</a></li>
<li>&nbsp;|&nbsp;</li>
<li><a href="">设为首页</a></li>
<li>&nbsp;|&nbsp;</li>
<li><a href="">联系我们</a></li>
</ul>
</div>
<!--站点导航栏-->
<div id="nav">
<img src="images/navleft.jpg"/>
<ul>
<?php foreach ($nav as $navitem):?>
<li><a href="#"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php endforeach;?>
</ul>
<img src="images/navright.jpg"/>
</div>
