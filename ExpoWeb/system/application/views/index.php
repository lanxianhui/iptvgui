<div id="notice">
<span>网站公告：</span>
<?php foreach($notice as $noticeitem):?>
<span style="color:black">
<?php echo $noticeitem["catdesc"] ?>
</span>
<?php endforeach;?>
</div>
<div id="icontent">
<div id="iflash">
<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="310" height="451">
  <param name="movie" value="swf/index.swf">
  <param name="quality" value="high">
  <param name="wmode" value="opaque">
  <param name="swfversion" value="8.0.35.0">
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="swf/expressInstall.swf">
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="swf/index.swf" width="310" height="451">
    <!--<![endif]-->
    <param name="quality" value="high">
    <param name="wmode" value="opaque">
    <param name="swfversion" value="8.0.35.0">
    <param name="expressinstall" value="swf/expressInstall.swf">
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
</div>
<div id="mcontent">
<dl>
<dt>
<?php if($selectcat == 1){?>
<a href="index.php/main/index/7/1" class="active">世博信息</a>
<a href="index.php/main/index/7/2" class="deactive">课程通告</a>
<a href="index.php/main/index/7/3" class="deactive">图文热点</a>
<?php }else if($selectcat == 2){?>
<a href="index.php/main/index/7/1" class="deactive">世博信息</a>
<a href="index.php/main/index/7/2" class="active">课程通告</a>
<a href="index.php/main/index/7/3" class="deactive">图文热点</a>
<?php }else{?>
<a href="index.php/main/index/7/1" class="deactive">世博信息</a>
<a href="index.php/main/index/7/2" class="deactive">课程通告</a>
<a href="index.php/main/index/7/3" class="active">图文热点</a>
<?php }?>
<a href="index.php/main/news/1/1" class="right">+更多</a>
</dt>
<dd>
<ul id="inlistview">
	<?php foreach($newslist as $listitem):?>
	<li><a href="index.php/main/newsinfo/1/<?php echo $selectcat ?>/<?php echo $listitem["id"] ?>/"><?php echo $listitem["newstitle"] ?></a>
	<span><?php $date =  (explode(" ", $listitem["pubtime"])); ?>
		<?php $result =  (explode("-", $date[0])); ?>
		<?php echo "[".$result[0]."-".$result[1]."]" ?></span>
	</li>
	<?php endforeach;?>
	</ul>
</dd>
</dl>
<div id="back">
<dl>
<dt><a href="index.php/main/scatinfo/2/12" class="leftlink">背景介绍</a><a href="index.php/main/scatinfo/2/12" class="right">+更多</a></dt>
<dd>
<div id="backcontent">
<?php foreach($servicecat as $aitem):?>
<?php echo $aitem["catdesc"]?>
<?php endforeach;?>
</div>
</dd>
</dl>
</div>
</div>
<div id="rcontent">
<div id="search"></div>
<div id="impnews"></div>
<div id="call">
<img src="images/home_03.jpg"/>
</div>
</div>
</div>
<div id="iexpert">
<dl>
<dt><a href="index.php/main/knowledgecity/4/6">知名专家</a></dt>
<dd>
<?php foreach($indexexpert as $eitem):?>
<a href="index.php/main/expertinfo/4/<?php echo $selectcat ?>/<?php echo $eitem["id"] ?>/0" target="_blank">
<img src="upload/<?php echo $eitem["userpic"] ?>"/>
</a>
<?php endforeach;?>
</dd>
</dl>
</div>
<div id="bottom">
<div id="friend">
<a href=""  class="title">友情链接</a><br/> 
<ul>
<?php foreach($indexlink as $linkitem):?>
<a href="<?php echo $linkitem["linkaddress"] ?>" target="_blank"><?php echo $linkitem["linkname"] ?></a>
<?php endforeach;?>
</ul>
</div>
<div id="partner">
<a href="index.php/main/partner/6/8" class="title">合作伙伴</a>
<ul>
<?php foreach($indexpartner as $pitem):?>
<li><a href="<?php echo $pitem["paddress"] ?>" target="_blank"><?php echo $pitem["pname"] ?></a></li>
<?php endforeach;?>
</ul>
</div>
</div>

