function searchList(){
	var keyword = jQuery("#keyword").attr("value");
	if( keyword == ""){
		alert("对不起，请输入您的搜索关键字！");
	}else{
		var inputValue = encodeURIComponent(keyword).replace(/%/g,"_");
		window.location = jQuery("#rooturl").attr("value") +"index.php/main/search/" + inputValue + "/0";
	}
}