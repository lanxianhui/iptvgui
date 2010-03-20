<?php if(count($root) ==0){?>
<?php $adid = 1;?>
<?php }?>
<?php foreach($root as $entry): $adid = $entry["id"];?>
<?php endforeach;?>
<div id="ad">
<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="916" height="240">
  <param name="movie" value="swf/ad<?php echo $adid ?>.swf">
  <param name="quality" value="high">
  <param name="wmode" value="opaque">
  <param name="swfversion" value="8.0.35.0">
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="swf/expressInstall.swf">
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="swf/ad<?php echo $adid ?>.swf" width="916" height="240">
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
