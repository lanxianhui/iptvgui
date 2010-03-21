
<div id="content">
<div id="info">
<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span style="color:black;">所在位置：</span>
<a href="index.php/main/index">首页</a>
<!-- <span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/elegant/<?php echo $rootid ?>/1"><?php echo $entry["rootname"] ?></a> -->
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["catname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="leftbar">
<dl>
<dt><a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $selectcat ?>"><img src="images/0<?php echo $rootid ?>.jpg"/></a>
</dt>
<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<?php if($selectcat == $citem["id"]){?>
<li class="activeli"><a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="active"><?php echo $citem["catname"] ?></a></li>
<?php }else{?>
<li class="deactiveli"><a href="index.php/main/consulting/<?php echo $rootid ?>/<?php echo $citem["id"] ?>" class="deactive"><?php echo $citem["catname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>

<div id="rightbar">
<label>如果你有意向与我们合作，请留言给我们，我们会及时给予回复</label>
<table>
<tr>
<td></td><td></td><td></td>
</tr>
<tr>
	<td class="label">称呼：</td>
	<td><input id="title"  type="text"/></td>
	<td  class="notice">*姓名和性别尊称</td>
</tr>
<tr>
	<td class="label">公司：</td>
	<td><input id="company"  type="text"/></td>
	<td  class="notice">*公司全称</td>
</tr>
<tr>
	<td class="label">电话：</td>
	<td><input id="phone"  type="text"/></td>
	<td  class="notice">*固定电话或手机</td>
</tr>
<tr>
	<td class="label">内容：</td>
	<td><textarea id="infocontent" ></textarea></td>
	<td  class="notice">*资讯内容，您有不清楚的，或者其他方面的问题可以输入！</td>
</tr>
<tr>
	<td></td>
	<td><a onclick="submitSign('<?php echo base_url() ?>')" class="submit">提交</a></td>
	<td></td>
</tr>
</table>
</div>

</div>
</div>
