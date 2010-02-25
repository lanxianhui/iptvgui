<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/search/<?php echo $keyword ?>/">搜索结果</a>
<div id="searchbox" style="padding-top:0px;">
<input type="text" id="keyword"/><a href="#" onclick="searchList();return false;"><img src="images/search_13.jpg"/></a>
</div>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/news/<?php echo $rootid ?>/"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

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
	<a href="index.php/main/search/<?php echo $keyword ?>/<?php echo $offset ?>">
	搜索结果
	</a>
	</dt>
	<dd>
	<div id="newspic">
	<?php foreach ($resultlist as $sritem):?>
	<div class="line">
		<img src="upload/<?php echo $sritem["newsimg"] ?>"/>
		<div>
		<h4><a target="_blank" href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sritem["id"] ?>"><?php echo $sritem["newstitle"] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $date =  (explode(" ", $sritem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo "[".$result[0]."-".$result[1]."]" ?>
		</h4>
		<div class="info"><?php echo $sritem["newsdesc"]?></div>
		<a target="_blank" href="index.php/main/newsinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sritem["id"] ?>">+点击查看更多</a>
		</div>
	</div>
	<?php endforeach;?>
	</div>
	<div class="page"  style="width:420px;float:left;"><?php echo $this->pagination->create_links();?></div>
	</dd>
</dl>
<?php endforeach;?>
</div>
</div>


