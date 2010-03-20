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
	var username = jQuery("#username").attr("value");
	var email = jQuery("#email").attr("value");
	var mobile = jQuery("#mobile").attr("value");
	var phone = jQuery("#phone").attr("value");
	var address = jQuery("#address").attr("value");
	var company = jQuery("#company").attr("value");
	var contact = jQuery("#contact").attr("value");
	if(validateNull(username)){
		alert("对不起，请输入您的用户姓名！");
		return;
	}
	if(validateNull(email)){
		alert("对不起，请输入您的用户Email地址！");
		return;
	}
	if(validateNull(mobile)){
		alert("对不起，请输入您的手机号码！");
		return;
	}
	if(validateNull(phone)){
		alert("对不起，请输入您的固定电话！");
		return;
	}
	if(validateNull(address)){
		alert("对不起，请输入居住地址！");
		return;
	}
	if(validateNull(company)){
		alert("对不起，请输入您的单位地址！");
		return;
	}
	if(validateNull(contact)){
		alert("对不起，请输入您的联系方式！");
		return;
	}
	jQuery.ajax({
		type:"POST",
		url:baseurl + "index.php/main/submitSign",
		data:{
			username:username,
			email:email,
			mobile:mobile,
			phone:phone,
			address:address,
			company:company,
			contact:contact
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
	jQuery("#username").attr("value","");
	jQuery("#email").attr("value","");
	jQuery("#mobile").attr("value","");
	jQuery("#phone").attr("value","");
	jQuery("#address").attr("value","");
	jQuery("#contact").attr("value","");
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
