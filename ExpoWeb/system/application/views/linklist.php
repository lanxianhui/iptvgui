<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/linklist/<?php echo $rootid ?>/<?php echo $selectcat ?>">
相关链接
</a>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt></dt>

<dd>
<ul>
<?php foreach ($catmenu as $citem):?>

<li><a href="index.php/main/catinfo/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>

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
	<a href="index.php/main/linklist/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	相关链接
	</a>
	</dt>
	<dd>
	<div class="infocontent">
	<?php foreach ($friend as $flitem):?>
	<a href="<?php echo $flitem["linkaddress"]?>" class="friendlink" target="_blank"><?php echo $flitem["linkname"] ?></a>
	<?php endforeach;?>
	</div>
	</dd>
</dl>
<?php endforeach;?>

</div>
</div>


