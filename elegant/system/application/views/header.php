<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<base href="<?php echo base_url(); ?>"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CHINYA DESIGN主页</title>
<link href="css/site.css" type="text/css" rel="stylesheet"/>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/swfobject.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
</head>
<body>
<input id="rooturl" value="<?php echo base_url() ?>" type="hidden"/>
<!--站点头部-->
<div id="header">
<a href="index.php"><img src="images/logo_01.jpg"/></a>
<a href="index.php"><img src="images/logo_02.jpg"/></a>
</div>

<!--站点导航栏-->
<div id="nav">
<ul>
<?php foreach ($nav as $navitem):?>
<?php if($navitem["id"] == 1){?>
<li><a href="index.php/main/index" <?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>>
<?php echo $navitem["rootname"] ?>
</a></li>

<?php }else if($navitem["id"] == 2){?>
<li><a href="index.php/main/elegant/<?php echo $navitem["id"] ?>/1"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>

<?php }else if($navitem["id"] == 6){?>
<li><a href="index.php/main/join/<?php echo $navitem["id"] ?>/6"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>
<?php }else if($navitem["id"] == 7){?>
<li><a href="index.php/main/contact/<?php echo $navitem["id"] ?>/10"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>
<?php }else if($navitem["id"] == 3){?>
<li><a href="index.php/main/cases/<?php echo $navitem["id"] ?>/14"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>

<?php }else if($navitem["id"] == 5){?>
<li><a href="index.php/main/consulting/<?php echo $navitem["id"] ?>/13"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>

<?php }else if($navitem["id"] == 4){?>
<li><a href="index.php/main/news/<?php echo $navitem["id"] ?>/11"<?php if($selectroot == $navitem["id"]){?>
style="font-weight:900;"
<?php }?>><?php echo $navitem["rootname"] ?></a></li>

<?php }else{?>
<li><a href="index.php/main/service/<?php echo $navitem["id"] ?>"><?php echo $navitem["rootname"] ?></a></li>
<?php if($navitem["id"] != 7){?>

<?php }?>
<?php }?>
<?php endforeach;?>
</ul>
</div>

