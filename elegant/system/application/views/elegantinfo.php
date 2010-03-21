
<div id="content">
<div id="info">
<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span style="color:black;">所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/1"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="leftbar">
<dl>
<dt><a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a>
</dt>
<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<?php if($selectcat == $citem["id"]){?>
<li class="activeli"><a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="active"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li class="deactiveli"><a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="deactive"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>

<div id="rightbar">
<?php foreach ($team as $pitem):?>
	<div class="infocontent" id="serviceinfo" style="min-height:400px;">
	<h4 style="text-align:center;float:left; width:90%;"><?php echo $pitem["teamname"] ?></h4>
	<h5 style="text-align:center;float:left;width:90%;">成员职位：<?php echo $pitem["teamjobs"]; ?></h5>
	<div style="text-align:center;float:left;width:90%;"><img style="width:121px; height:160px;" src="upload/<?php echo $pitem["teampic"] ?>"/></div>
	<div style=" clear:both;"><?php echo $pitem["teamdesc"] ?></div>
	</div>
	<div style="float:left;width:100%;">
	<a style="color:blue;" href="index.php/main/elegant/2/2">&lt;&lt;返回</a>
	</div>
	<?php endforeach;?>
</div>

</div>
</div>
