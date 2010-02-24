<div id="footer">
<ul>
	<li><a href="index.php/main/index">返回首页</a></li>
	<li>&nbsp;|&nbsp;</li>
    <li><a href="#">相关链接</a></li>
    <?php foreach($footer as $fitem ):?>
    <li>&nbsp;|&nbsp;</li>
    <li><a href="index.php/main/catinfo/7/<?php echo $fitem["id"] ?>"><?php echo $fitem["catname"] ?></a></li>
    <?php endforeach;?>
</ul>
<div id="copyright">
公司网站版权所有，未经许可严禁复制或镜像&nbsp;违者必究<br/>
@ Copyright 2009 feel8 web design studio.<br/>
<img src="images/ipc.jpg"/>
</div>
</div>
</body>
</html>
