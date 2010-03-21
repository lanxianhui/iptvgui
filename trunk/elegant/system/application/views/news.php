
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
<ul>
<?php foreach($newslist as $nitem):?>
<li><span>
<?php $date =  (explode(" ", $nitem["pubtime"])); ?>
<?php echo  $date[0] ?></span>
<a href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectncat ?>/<?php echo $nitem["id"] ?>/<?php echo $offset ?>"><?php echo $nitem["newstitle"] ?></a></li>
<?php endforeach;?>
</ul>
<div class="page"  style="float:left;"><?php echo $this->pagination->create_links();?></div>
</div>

</div>
</div>



