<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $selectcat ?>"><?php echo $entry["rootname"] ?></a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/sign/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $offset ?>">
我要报名
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
<li><a href="index.php/main/knowledgecity/<?php echo $rootid ?>/<?php echo $citem["id"] ?>"><?php echo $citem["catname"] ?></a></li>
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
	<a href="index.php/main/sign/<?php echo $rootid ?>/<?php echo $selectcat ?>/<?php echo $offset ?>">
	我要报名
	</a>
	</dt>
	<dd>
	<div id="signform">
	<label>请填写您的报名信息：</label>
	<table>
	<tr><td>用户姓名：</td><td><input type="text" id="username"/></td></tr>
	<tr><td>用户Email：</td><td><input type="text" id="email"/></td></tr>
	<tr><td>手机号码：</td><td><input type="text" id="mobile"/></td></tr>
	<tr><td>固定电话：</td><td><input type="text" id="phone"/></td></tr>
	<tr><td>居住地址：</td><td><input type="text" id="address"/></td></tr>
	<tr><td>报名单位：</td><td><input type="text" id="company"/></td></tr>
	<tr><td>联系方式：</td><td><textarea id="contact" style="width:450px; height:100px;"></textarea></td></tr>
	<tr><td></td><td><input type="button" onclick="submitSign('<?php echo base_url(); ?>');" value="提交报名"/>
	<input type="button" onclick="returnPage('<?php echo base_url() ?>','<?php echo $rootid ?>','<?php echo $selectcat ?>','<?php echo $offset ?>')" value="返回"/>
	</td></tr>
	</table>
	</div>
	</dd>
</dl>
<?php endforeach;?>
</div>
</div>


