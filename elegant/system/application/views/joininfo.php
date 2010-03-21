
<div id="content">
<div id="info">
<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span style="color:black;">所在位置：</span>
<a href="index.php/main/index">首页</a>
<!--  <span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/1"><?php echo $entry["rootname"] ?></a>-->
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/join/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="leftbar">
<dl>
<dt><a href="index.php/main/join/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a>
</dt>
<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<?php if($selectcat == $citem["id"]){?>
<li class="activeli"><a href="index.php/main/join/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="active"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li class="deactiveli"><a href="index.php/main/join/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="deactive"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>

<div id="rightbar">
<label class="jointitle">如果您足够自信，并且热爱生活，对未来充满期待，那您就是我们的一份子</label>
<?php foreach($infocontent as $citem):?>
<?php echo $citem["servicedesc"] ?>
<div style="float:left;width:100%;">
	<a style="color:blue;" href="index.php/main/join/6/6">&lt;&lt;返回</a>
	</div>
<?php endforeach;?>
</div>

</div>
</div>

