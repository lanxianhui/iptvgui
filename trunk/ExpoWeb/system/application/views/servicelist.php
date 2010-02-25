<?php foreach($root as $entry):$rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/service/<?php echo $rootid ?>"><?php echo $entry["rootname"] ?></a>
<div id="searchbox" style="padding-top:0px;">
<input type="text" id="keyword"/><a href="#" onclick="searchList();return false;"><img src="images/search_13.jpg"/></a>
</div>
</div>
<?php endforeach;?>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/service/<?php echo $rootid ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a></dt>
<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<!-- 判断是否项目概况，就是需要介绍详细内容的页面 -->
<?php if($rootid == 2){?>
<li><a href="index.php/main/scatinfo/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li><a href=""><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
<img src="images/expobar.jpg"/>
</div>
<div class="rcontent">

</div>
</div>
