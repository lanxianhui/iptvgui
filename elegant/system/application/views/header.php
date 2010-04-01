<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<base href="<?php echo base_url(); ?>"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CHINYA DESIGN主页</title>
<link href="css/site.css" type="text/css" rel="stylesheet"/>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jqueryimg.js" type="text/javascript"></script>
<script src="js/swfobject.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
</head>
<body>

<input id="rooturl" value="<?php echo base_url() ?>" type="hidden"/>
<!--站点头部-->
<div id="page">
<div id="header_left"></div>
<div id="header">
<a href="index.php"><img src="images/logo_01.jpg"/></a>

<img class="phone" src="images/logo_02.jpg"/>
<div id="nav">
<ul>
<?php $html = "style=\"color:#98c143;font-weight:700;\"";?>
<li style="width:60px;"><a href="index.php/main" style="text-align:left;"
<?php if($selectroot == 0){ echo $html; }?>>首页</a></li>
<li><a href="index.php/main/elegant/2/1" <?php if($selectroot == 2){ echo $html; }?>>关于清雅</a>
<ul>
<?php foreach ($dropmenu as $citem):?>
<?php if(2 == $citem["rootid"]){?>
<li><a href="index.php/main/elegant/<?php echo $selectroot ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</li>
<li><a href="index.php/main/cases/1" <?php if($selectroot == 1){ echo $html; }?>>项目案例</a>
<ul>
<?php foreach ($casesmenu as $citem):?>
<li><a href="index.php/main/cases/<?php echo $citem["id"] ?>"><?php echo $citem["rootname"] ?></a></li>
<?php endforeach;?>
</ul>
</li>
<li><a href="index.php/main/news/4/1" <?php if($selectroot == 4){ echo $html; }?>>新闻资讯</a>
<ul>
<?php foreach ($newsmenu as $citem):?>
<li><a href="index.php/main/news/<?php echo $selectroot ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php endforeach;?>
</ul>
</li>
<li><a href="index.php/main/consulting/5/13" <?php if($selectroot == 5){ echo $html; }?>>项目咨询</a>
<!--  <ul>
<?php foreach ($dropmenu as $citem):?>
<?php if(5 == $citem["rootid"]){?>
<li><a href="index.php/main/consulting/<?php echo $selectroot ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>-->
</li>
<li><a href="index.php/main/join/6/6" <?php if($selectroot == 6){ echo $html; }?>>加入我们</a>
<!--  <ul>
<?php foreach ($dropmenu as $citem):?>
<?php if(6 == $citem["rootid"]){?>
<li><a href="index.php/main/join/<?php echo $selectroot ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>-->
</li>
<li><a href="index.php/main/contack/7/10" <?php if($selectroot == 7){ echo $html; }?>>联系我们</a>
<!--  <ul>
<?php foreach ($dropmenu as $citem):?>
<?php if(7 == $citem["rootid"]){?>
<li><a href="index.php/main/contack/<?php echo $selectroot ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>-->
</li>
<li style="width:60px;"><a href="index.php/main/elegant/8/15" style="text-align:right;" <?php if($selectroot == 8){ echo $html; }?>>English</a></li>
</ul>
</div>
</div>
</div>
<div id="header_right"></div>

