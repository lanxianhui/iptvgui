<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<base href="<?php echo base_url(); ?>"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHANGHAI CHINA EXPO主页</title>
<link href="css/site.css" type="text/css" rel="stylesheet"/>
<script src="js/swfobject.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
</head>
<body>
<!--站点头部-->
<div id="header">
<ul id="h_u_link">
<li><a href="javascript:window.external.AddFavorite('<?php echo base_url(); ?>', '“SHANGHAI EXPO”')" target="_self">收藏本站</a></li>
<li>&nbsp;|&nbsp;</li>
<li><a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('<?php echo base_url(); ?>');return(false);" style="behavior: url(#default#homepage)">设为首页</a></li>
<li>&nbsp;|&nbsp;</li>
<li><a href="mailto:silentbalanceyh@126.com">联系我们</a></li>
</ul>
</div>
<!--站点导航栏-->
<div id="nav">
<img src="images/navleft.jpg"/>
<ul>
<?php foreach ($nav as $navitem):?>
<?php if($navitem["id"] == 1){?>
<li><a href="index.php/main/newslist/-1/0"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else if($navitem["id"] == 2){?>
<li><a href="index.php/main/scatinfo/<?php echo $navitem["id"] ?>/12"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else if($navitem["id"] == 6){?>
<li><a href="index.php/main/partner/<?php echo $navitem["id"] ?>/8"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else if($navitem["id"] == 3){?>
<li><a href="index.php/main/myexpo/<?php echo $navitem["id"] ?>/2"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else if($navitem["id"] == 5){?>
<li><a href="index.php/main/recommend/<?php echo $navitem["id"] ?>/9"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else if($navitem["id"] == 4){?>
<li><a href="index.php/main/knowledgecity/<?php echo $navitem["id"] ?>/5"><?php echo $navitem["rootname"] ?></a></li>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }else{?>
<li><a href="index.php/main/service/<?php echo $navitem["id"] ?>"><?php echo $navitem["rootname"] ?></a></li>
<?php if($navitem["id"] != 6){?>
<li class="vline"><img src="images/vline.gif"/></li>
<?php }?>
<?php }?>
<?php endforeach;?>
</ul>
<img src="images/navright.jpg"/>
</div>
