<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $selectcat ?>"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/cases/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<!-- 判断是否需要介绍详细内容的页面 -->
<?php if($selectcat == $citem["id"]){?>
<li><img src="images/button_03.jpg"/><a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>
<div class="rcontent">
<?php foreach($content as $catitem):?>
<dl>
	<dt>
	<a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<?php if($selectcat == 2){?>
	
	<?php }else{?>
	<ul id="listview">
	<?php foreach($servicelist as $listitem):?>
	<li><a href="index.php/main/consultinginfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $listitem["id"] ?>/<?php echo $offset ?>"><?php echo $listitem["servicename"] ?></a>
	<span><?php $date =  (explode(" ", $listitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo $result[0]."-".$result[1]."-".$result[2] ?></span>
	</li>
	<?php endforeach;?>
	</ul>
	<div class="page"  style="width:480px;float:left;"><?php echo $this->pagination->create_links();?></div>
	<?php }?>
	</dd>
</dl>
<?php endforeach;?>

</div>
</div>
