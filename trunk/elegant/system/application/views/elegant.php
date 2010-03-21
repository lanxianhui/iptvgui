
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
<?php if($selectcat != 2){?>
<?php foreach($content as $citem):?>
<?php echo $citem["catdesc"] ?>
<?php endforeach;?>
<?php }else{?>
<?php foreach($team as $titem):?>
<div class="list">
<a href="index.php/main/elegantinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $titem["id"] ?>"><img src="upload/<?php echo $titem["teampic"] ?>"/></a>
<div class="listinfo">
<a class="listtitle" href="index.php/main/elegantinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $titem["id"] ?>"><?php echo $titem["teamname"] ?></a>
<label class="listjobs"><?php echo $titem["teamjobs"] ?></label>
<div class="remark">
<?php echo $titem["teamdesc"] ?>
</div>
</div>
</div>
<?php endforeach;?>
<?php }?>
</div>

</div>
</div>
