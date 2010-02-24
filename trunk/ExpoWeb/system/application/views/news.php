<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/news/<?php echo $rootid ?>/"><?php echo $entry["rootname"] ?></a>
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/myexpo/<?php echo $rootid ?>/"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

<dd>
<ul>
<?php foreach ($newscat as $citem):?>
<!-- 判断是否项目概况，就是需要介绍详细内容的页面 -->
<?php if($selectcat == $citem["id"]){?>
<li><img src="images/front.jpg"/><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
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
	<a href="index.php/main/myexpo/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<ul id="listview">
	<?php foreach($newslist as $listitem):?>
	<li><a href="index.php/main/myexpoinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $listitem["id"] ?>"><?php echo $listitem["newstitle"] ?></a>
	<span><?php $date =  (explode(" ", $listitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo $result[0]."-".$result[1]."-".$result[2] ?></span>
	</li>
	<?php endforeach;?>
	</ul>
	</dd>
</dl>
<?php endforeach;?>

</div>
</div>


