
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
<?php foreach($casecat as $citem):?>
<dl class="casetop">
<dt><a href="index.php/main/caselist/<?php echo $citem["rootid"] ?>/<?php echo $citem["id"] ?>" style="float:left;"><?php echo $citem["catname"]?></a> <a href="index.php/main/caselist/<?php echo $citem["rootid"] ?>/<?php echo $citem["id"] ?>">更多&gt;&gt;</a></dt>
<dd>
<?php foreach($cases as $ciitem):?>
<?php if($ciitem["catid"] == $citem["id"]){?>
<div class="">
<a href="index.php/main/casesinfo/<?php echo $ciitem["rootid"] ?>/<?php echo $ciitem["catid"] ?>/<?php echo $ciitem["id"] ?>">
<img class="aimage" src="upload/<?php echo $ciitem["casepic1"] ?>"/>
</a>
<img src="images/join_03.jpg"></img>
<a href="index.php/main/casesinfo/<?php echo $ciitem["rootid"] ?>/<?php echo $ciitem["catid"] ?>/<?php echo $ciitem["id"] ?>">
<?php echo $ciitem["casetitle"] ?>
</a>
</div>
<?php }?>
<?php endforeach;?>
</dd>
</dl>
<?php endforeach;?>
</div>
</div>
</div>


