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
	<?php foreach ($partnerinfo as $pitem):?>
	<div class="infocontent" id="serviceinfo">
	<h4><?php echo $pitem["username"] ?></h4>
	<h5>专家头衔：<?php echo $pitem["title"]?></h5>
	<img src="upload/<?php echo $pitem["userpic"] ?>"/>
	<div><?php echo $pitem["userdesc"] ?></div>
	</div>
	<div style="float:left;width:100%;">
	<a style="color:blue;" href="index.php/main/knowledgecity/<?php echo $rootid ?>/6/<?php echo $offset ?>">&lt;&lt;返回</a>
	</div>
	<?php endforeach;?>
	</dd>
</dl>
<?php endforeach;?>
</div>
</div>


