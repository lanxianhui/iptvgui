<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/news/<?php echo $rootid ?>/"><?php echo $entry["rootname"] ?></a>

</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/news/<?php echo $rootid ?>/"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

<dd>
<ul>
<?php foreach ($newscat as $citem):?>
<!-- 判断是否需要介绍详细内容的页面 -->
<?php if($selectcat == $citem["id"]){?>
<li><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>
<?php if($selectcat != 3){?>
<div class="mcontent">
<?php foreach($content as $catitem):?>
<dl>
	<dt>
	<a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<ul id="nlistview">
	<?php foreach($newslist as $listitem):?>
	<li><a href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $listitem["id"] ?>/<?php echo $offset ?>"><?php echo $listitem["newstitle"] ?></a>
	<span><?php $date =  (explode(" ", $listitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo "[".$result[0]."-".$result[1]."]" ?></span>
	</li>
	<?php endforeach;?>
	</ul>
	<div class="page"  style="width:420px;float:left;"><?php echo $this->pagination->create_links();?></div>
	</dd>
</dl>
<?php endforeach;?>
</div>
<div class="barcontent">
<dl>
	<dt>
	<a href="index.php/main/news/<?php echo $rootid ?>/3">
	</a>
	</dt>
	<dd>
	<div id="picbar">
	<?php foreach($newspiclist as $picitem):?>
	<a href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $picitem["id"] ?>/<?php echo $offset ?>" target="_blank">
	<img src="upload/<?php echo $picitem["newsimg"] ?>"/>
	</a><br/>
	<a class="link" title="<?php echo $picitem["newstitle"] ?>" href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $picitem["id"] ?>/<?php echo $offset ?>"  target="_blank">&gt;&nbsp;<?php echo $picitem["newstitle"] ?></a>
	<?php endforeach;?>
	</div>
	</dd>
</dl>
</div>
<?php }else{?>
<div class="rcontent">
<?php foreach($content as $catitem):?>
<dl>
	<dt>
	<a href="index.php/main/news/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<div id="newspic">
	<?php foreach ($newslist as $sitem):?>
	<div class="line">
		<img src="upload/<?php echo $sitem["newsimg"] ?>"/>
		<div>
		<h4><a href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>"><?php echo $sitem["newstitle"] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $date =  (explode(" ", $sitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo "[".$result[0]."-".$result[1]."]" ?>
		</h4>
		<div class="info"><?php echo $sitem["newsdesc"]?></div>
		<a href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>">+点击查看更多</a>
		</div>
	</div>
	<?php endforeach;?>
	</div>
	<div class="page"  style="width:420px;float:left;"><?php echo $this->pagination->create_links();?></div>
	</dd>
</dl>
<?php endforeach;?>
</div>
<?php }?>
</div>


