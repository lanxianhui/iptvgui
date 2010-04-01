<?php
session_start (); // Initialize session data
ob_start (); // Turn on output buffering
?>
<?php

include "ewcfg6.php"?>
<?php

include "ewmysql6.php"?>
<?php

include "phpfn6.php"?>
<?php

include "casescatinfo.php"?>
<?php

include "admininfo.php"?>
<?php

include "userfn6.php"?>
<?php

header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); // Date in the past
header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" ); // Always modified
header ( "Cache-Control: private, no-store, no-cache, must-revalidate" ); // HTTP/1.1 
header ( "Cache-Control: post-check=0, pre-check=0", false );
header ( "Pragma: no-cache" ); // HTTP/1.0
?>

<?php
include "header.php"?>
<script type="text/javascript" src="fileupload/jquery-1.2.1.min.js"></script>
<script type="text/javascript" src="fileupload/jquery.flash.js"></script>
<script type="text/javascript" src="fileupload/jquery.jqUploader.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	//$("input#example2").jqUploader({ afterScript: "fileupload/redirected.php", background: "FFFFDF", barColor: "64A9F6", allowedExt: "jpg|JPG|jpeg|JPEG" }); 
});

function submitform(){
	if( jQuery("#project").attr("value") == ""){
		alert("请输入项目名！");
		return false;
	}
	if( jQuery("#url").attr("value") == ""){
		alert("请输入该项目的链接地址！");
		return false;
	}
	return true;
}


</script>

<p><span class="phpmaker" style="white-space: nowrap;"> </span></p>
<form id="fileUploadForm" onsubmit="return submitform();"
	action="indexpic.php" method="post" enctype="multipart/form-data">
<div id="imgList">
<?php
$doc = new DOMDocument ();
$doc->load ( "../xml/index.xml" );

$books = $doc->getElementsByTagName ( "lookbook" );
$i = 0;
foreach ( $books as $book ) {
	$html = "<div style='float:left;margin-right:10px;width:200px;'>";
	$urls = $book->getElementsByTagName ( "url_pic" );
	$url = trim($urls->item ( 0 )->nodeValue);
	
	$links = $book->getElementsByTagName ( "big_pic" );
	$link = trim($links->item ( 0 )->nodeValue);
	$names = $book->getElementsByTagName ( "p_name" );
	$name = iconv ( "UTF-8", "GBK", trim($names->item ( 0 )->nodeValue));
	$ids = $book->getElementsByTagName("id");
	$id = trim($ids->item(0)->nodeValue);
	$html .= "<a href='../$link' target='_blank' style='float:left;'><img src='../$url' style='width:200px;height:100px;border:none;'/></a>";
	$html .= "<a href='../$link' target='_blank' style='float:left;margin-top:20px;color:black;width:100%; height:40px;'>$name</a>";
	if ($i == 0) {
		$html .= "<input type='radio' name='selectid' checked='true' value='$id'/>";
		$i ++;
	} else {
		$html .= "<input type='radio' name='selectid' value='$id'/>";
	}
	$html .= "</div>";
	echo $html;
}
?>
<div style="clear: both; padding: 20px; line-height: 3em;"><label
	for="project">项目名：</label><input type="text" name="project"
	id="project" /><br />
<label for="url">链接地址：</label><input type="text" name="url" id="url" /><br />
<label for="file">文件名:</label><input type="file" name="file" id="file" /><br />
<input type="submit" name="submit" value="我要上传" onclick="sumitform();" />
<input type="hidden" id="xmlValue" value="<?php
echo $url?>" /></div>
</div>
</form>
<?php // if (($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")&& ($_FILES["file"]["size"] < 20000))  {
if ($_FILES ["file"] ["error"] > 0) {
	echo "系统错误: " . $_FILES ["file"] ["error"] . "<br />";
} else {
	//echo "Upload: " . $_FILES ["file"] ["name"] . "<br />";
	//echo "Type: " . $_FILES ["file"] ["type"] . "<br />";
	//echo "Size: " . ($_FILES ["file"] ["size"] / 1024) . " Kb<br />";
	//echo "Temp file: " . $_FILES ["file"] ["tmp_name"] . "<br />";
	$nid =  $_POST ["selectid"];
	$nproject =  iconv("gbk","utf-8",$_POST ["project"]);
	$nurl = $_POST ["url"];
	$nfile = $_FILES ["file"] ["name"];
	
	
	if(!isset($nfile))
		return;

		
	$ext = end(explode(".",$nfile));
	$filename = Date("YmdHms");
	$newfile = $filename.".".$ext;
	//echo $newfile;
	
	$doc = new DOMDocument ();
	$doc->load ( "../xml/index.xml" );
	
	$books = $doc->getElementsByTagName ( "lookbook" );
	
	$writer = new DOMDocument("1.0");
	$writer ->formatOutput = true;
	
	$r = $writer->createElement("imagesshow");
	$writer->appendChild($r);
	$oldFile = "";
	foreach ( $books as $book ) {
		//$html = "<div style='float:left;margin-right:10px;width:200px;'>";
		
		$urls = $book->getElementsByTagName ( "url_pic" );
		$ourl = $urls->item ( 0 )->nodeValue;
		
		$links = $book->getElementsByTagName ( "big_pic" );
		$olink = $links->item ( 0 )->nodeValue;
		
		$projects = $book->getElementsByTagName("p_name");
		$oproject = $projects->item(0)->nodeValue;
		
		$ids = $book->getElementsByTagName ( "id" );
		$oid = $ids->item ( 0 )->nodeValue;
		
		if( trim($oid) == trim($nid)){
			$b = $writer->createElement("lookbook");
			$url_pic = $writer->createElement("url_pic");
			$url_pic->appendChild($writer->createTextNode("xml/$newfile"));
			$b->appendChild($url_pic);
			
			$oldFile = $ourl;
			
			$big_pic = $writer->createElement("big_pic");
			$big_pic->appendChild($writer->createTextNode("$nurl"));
			$b->appendChild($big_pic);
			
			$p_name = $writer->createElement("p_name");
			$p_name->appendChild($writer->createTextNode("$nproject"));
			$b->appendChild($p_name);
			
			$pid = $writer->createElement("id");
			$pid->appendChild($writer->createTextNode("$nid"));
			$b->appendChild($pid);
			
			$r->appendChild($b);
		}else{
			$b = $writer->createElement("lookbook");
			$url_pic = $writer->createElement("url_pic");
			$url_pic->appendChild($writer->createTextNode("$ourl"));
			$b->appendChild($url_pic);
			
			$big_pic = $writer->createElement("big_pic");
			$big_pic->appendChild($writer->createTextNode("$olink"));
			$b->appendChild($big_pic);
			
			$p_name = $writer->createElement("p_name");
			$p_name->appendChild($writer->createTextNode("$oproject"));
			$b->appendChild($p_name);
			
			$pid = $writer->createElement("id");
			$pid->appendChild($writer->createTextNode("$oid"));
			$b->appendChild($pid);
			
			$r->appendChild($b);
		}
	}
	unlink("../$oldFile");
	if (file_exists ( "../xml/" . $newfile )) {
		move_uploaded_file ( $_FILES ["file"] ["tmp_name"], "../xml/" .$newfile );
		//echo "Stored in: " . "../xml/" . $_FILES ["file"] ["name"];
	} else {
		move_uploaded_file ( $_FILES ["file"] ["tmp_name"], "../xml/" .$newfile);
		//echo "Stored in: " . "../xml/" . $_FILES ["file"] ["name"];
		$writer->save("../xml/index.xml");
		header("Location:indexpic.php");
		//header("Location:indexpic.php");
	}
}
//}else  {  echo "";  }?>
<?php

include "footer.php" ?>
