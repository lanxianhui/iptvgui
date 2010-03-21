<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="content">
<div id="info">
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $selectcat ?>"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a>

<ul>
<?php foreach ($catmenu as $citem):?>
<?php if($selectcat == $citem["id"]){?>
<li><img src="images/button_03.jpg"/><a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><img src="images/button_02.jpg"/><a href="index.php/main/elegant/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>

</div>
</div>
