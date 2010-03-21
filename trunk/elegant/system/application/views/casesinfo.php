
<div id="content">
<div id="info">
<?php foreach($root as $entry): $rootid = $entry["id"];?>
<div id="adnav">
<span style="color:black;">所在位置：</span>
<a href="index.php/main/index">首页</a>
<span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span>
<a href="index.php/main/cases/<?php echo $selectcat ?>">
<?php foreach($content as $catitem):?>
<?php echo $catitem["rootname"] ?>
<?php endforeach;?>
</a>
</div>
<?php endforeach;?>
<div id="leftbar">
<dl>
<dt><a href="index.php/main/cases/<?php echo $selectcat ?>"><img src="images/03.jpg"/></a>
</dt>
<dd>
<ul>
<?php foreach ($catmenu as $citem):?>
<?php if($selectcat == $citem["id"]){?>
<li class="activeli"><a href="index.php/main/cases/<?php echo $citem["id"] ?>" class="active"><?php echo $citem["rootname"] ?></a></li>
<?php }else{?>
<li class="deactiveli"><a href="index.php/main/cases/<?php echo $citem["id"] ?>" class="deactive"><?php echo $citem["rootname"] ?></a></li>
<?php }?>
<?php endforeach;?>
</ul>
</dd>
</dl>
</div>

<div id="rightbar">
<?php foreach($cases as $ciitem):?>
<div id="caseinfo">
<label class="title"><?php echo $ciitem["casetitle"]?></label>
<img id="focus" src="upload/<?php echo $ciitem["casepic1"] ?>"/>
<?php for($i = 1; $i <= 8; $i++ ){?>
<?php if($ciitem["casepic$i"] != ""){?>
<img class="clickimg" onclick="changePic(this)" src="upload/<?php echo $ciitem["casepic$i"] ?>"/>
<?php }else{?>
<img class="clickimg" src="images/nopic.jpg"/>
<?php }?>
<?php }?>
<label class="stitle">项目描述：</label>
<p><?php echo $ciitem["casedesc"] ?></p>
</div>
<div style="text-align:center;width:100%;">
<a style="margin-left:250px;" href="index.php/main/caselist/<?php echo $ciitem["rootid"] ?>/<?php echo $ciitem["catid"]?>/<?php echo $offset ?>"><img src="images/back_03.jpg"/></a>
<?php endforeach;?>
</div>

</div>
</div>
</div>



