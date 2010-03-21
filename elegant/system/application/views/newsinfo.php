
<div id="content">
<div id="info">
<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span style="color:black;">所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/news/<?php echo $rootid ?>/1"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $selectncat ?>">
<?php foreach($newscat as $catitem):?>
<?php if($selectncat == $catitem["id"]){?>
<?php echo $catitem["catname"] ?>
<?php }?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="leftbar">
<dl>
<dt><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $selectncat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a>
</dt>
<dd>
<ul>
<?php foreach ($newscat as $citem):?>
<?php if($selectncat == $citem["id"]){?>
<li class="activeli"><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="active"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li class="deactiveli"><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="deactive"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>

<div id="rightbar">
<?php foreach ($newsinfo as $pitem):?>
	<div class="infocontent" id="serviceinfo">
	<h4 style="text-align:center;width:90%;"><?php echo $pitem["newstitle"] ?></h4>
	<h5 style="text-align:center;width:90%;">发布时间：<?php $date =  (explode(" ", $pitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo $result[0]."-".$result[1]."-".$result[2] ?></h5>
	<div><?php echo $pitem["newsdesc"] ?></div>
	</div>
	<div style="float:left;width:100%;">
	<a style="color:blue;" href="index.php/main/news/1/<?php echo $pitem["catid"]?>/<?php echo $offset ?>">&lt;&lt;返回</a>
	</div>
	<?php endforeach;?>
</div>
</div>
</div>



