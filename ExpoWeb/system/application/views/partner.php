<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $selectcat ?>"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
<div id="searchbox" style="padding-top:0px;">
<input type="text" id="keyword"/><a href="#" onclick="searchList();return false;"><img src="images/search_13.jpg"/></a>
</div>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<!-- 判断是否项目概况，就是需要介绍详细内容的页面 -->
<?php if($selectcat == $citem["id"]){?>
<li><img src="images/front.jpg"/><a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
<img src="images/expobar.jpg"/>
</div>
<div class="rcontent">
<?php foreach($content as $catitem):?>
<dl>
	<dt><img src="images/ctitle_03.jpg"/>
	<a href="index.php/main/partner/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<?php if($selectcat == 8){?>
	<div id="partnerlist" class="infocontent">
	<?php foreach ($partner as $pitem):?>
	<a href="<?php echo $pitem["paddress"] ?>" target="_blank"><img src="upload/<?php echo $pitem["pimage"] ?>"/></a>
	<?php endforeach;?>
	</div>
	<?php }else{?>
	<div id="sport">
	<?php foreach ($servicelist as $sitem):?>
	<div class="line">
		<img src="upload/<?php echo $sitem["servicepic"] ?>"/>
		<div>
		<h4><a href="index.php/main/partnerinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>"><?php echo $sitem["servicename"] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $date =  (explode(" ", $sitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo $result[0]."-".$result[1]."-".$result[2] ?>
		</h4>
		<div class="info"><?php echo $sitem["servicedesc"]?></div>
		<a href="index.php/main/partnerinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>">+点击查看更多</a>
		</div>
	</div>
	<?php endforeach;?>
	</div>
	<?php }?>
	</dd>
</dl>
<?php endforeach;?>
</div>
</div>

