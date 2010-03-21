function searchList(){
	var keyword = jQuery("#keyword").attr("value");
	if( keyword == ""){
		alert("对不起，请输入您的搜索关键字！");
	}else{
		var inputValue = encodeURIComponent(keyword).replace(/%/g,"_");
		window.location = jQuery("#rooturl").attr("value") +"index.php/main/search/" + inputValue + "/0";
	}
}

function submitSign(baseurl){
	var title = jQuery("#title").attr("value");
	var company = jQuery("#company").attr("value");
	var phone = jQuery("#phone").attr("value");
	var content = jQuery("#infocontent").html();
	if(validateNull(title)){
		alert("对不起，请输入您称呼！");
		return;
	}
	if(validateNull(company)){
		alert("对不起，请输入您的公司全称！");
		return;
	}
	if(validateNull(phone)){
		alert("对不起，请输入您的固定电话或者手机！");
		return;
	}
	if(validateNull(content)){
		alert("对不起，请输入您的咨询内容！");
		return;
	}
	jQuery.ajax({
		type:"POST",
		url:baseurl + "index.php/main/submitSign",
		data:{
			title:title,
			phone:phone,
			company:company,
			content:content
		},
		success:function(data,textStatus){
			if(data == "Success"){
				alert("恭喜，您的报名已经提交！")
				resetForm();
			}else{
				alert("系统故障，请刷新页面重新提交或者联系管理员！");
			}
		}
	});
}

function returnPage(baseurl,rootid,catid,offset){
	window.location = baseurl + "index.php/main/knowledgecity/" + rootid + "/" + catid + "/" + offset;
}

function resetForm(){
	jQuery("#phone").attr("value","");
	jQuery("#title").attr("value","");
	jQuery("#infocontent").attr("value","");
	jQuery("#company").attr("value","");
}

function validateNull(objectvalue)
{
	if( objectvalue.toString().length == 0 || objectvalue == ""){
		return true;
	}else{
		return false;
	}
}
