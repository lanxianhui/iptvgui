<div id="adnav">
<span>所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/newslist">信息资讯</a>
<span>&nbsp;&gt;&nbsp;</span>
<a href="index.php/main/newslist">世博信息</a>
</div>
<div id="content">
<div class="lcontent">
<dl>
<dt><a href="index.php/main/newslist"><img src="images/newstitle.jpg"/></a></dt>
<dd>
<ul>
<?php foreach ($newscat as $citem):?>
<li><a href=""><?php echo $citem["catname"] ?></a></li>
<?php endforeach;?>
</ul>
</dd>
</dl>
<img src="images/expobar.jpg"/>
</div>
<div class="rcontent">

</div>
</div>