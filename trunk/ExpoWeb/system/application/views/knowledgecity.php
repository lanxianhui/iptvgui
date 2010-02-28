<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $selectcat ?>"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
<div id="searchbox" style="padding-top:0px;">
<input type="text" id="keyword"/><a href="#" onclick="searchList();return false;"><img src="images/search_13.jpg"/></a>
</div>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>

<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<!-- 判断是否项目概况，就是需要介绍详细内容的页面 -->
<?php if($selectcat == $citem["id"]){?>
<li><img src="images/front.jpg"/><a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" style="font-weight:700;margin-left:6px;"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
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
	<a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $selectcat ?>">
	<?php echo $catitem["catname"] ?>
	</a>
	</dt>
	<dd>
	<?php if($selectcat ==6){?>
	<div id="expert">
	<?php foreach ($expert as $sitem):?>
	<div class="line">
		<img src="upload/<?php echo $sitem["userpic"] ?>"/>
		<div>
		<h4><a><?php echo $sitem["title"] ?>：</a><a href="index.php/main/expertinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>/<?php echo $offset; ?>"><?php echo $sitem["username"] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		</h4>
		<div class="info"><?php echo $sitem["userdesc"]?></div>
		<a href="index.php/main/expertinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $sitem["id"] ?>/<?php echo $offset; ?>">+点击查看更多</a>
		</div>
	</div>
	<?php endforeach;?>
	</div>
	
	<?php }else{?>
	<ul id="listview" style="width:490px;">
	<?php foreach($servicelist as $listitem):?>
	<li><a href="index.php/main/knowledgecityinfo/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $listitem["id"] ?>/<?php echo $offset ?>"><?php echo $listitem["servicename"] ?></a>
	<span><?php $date =  (explode(" ", $listitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo $result[0]."-".$result[1]."-".$result[2] ?></span>
	</li>
	<?php endforeach;?>
	</ul>
	<?php }?>
	
	<div id="sign">
	<a href="index.php/main/sign/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $offset ?>"><img src="images/button_03.gif"/></a>
	<a href="index.php/main/signflow/-1/20"><img src="images/button_06.jpg"/></a>
	</div>
	<div class="page"  style="width:480px;float:left;"><?php echo $this->pagination->create_links();?></div>
	</dd>
</dl>
<?php endforeach;?>
</div>
</div>

