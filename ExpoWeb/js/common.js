
function submitSign(baseurl){
	var title = jQuery("#title").attr("value");
	var content = jQuery("#content").attr("value");
	var phone = jQuery("#phone").attr("value");
	var company = jQuery("#company").attr("value");
	if(validateNull(title)){
		alert("对不起，请输入您的姓名和性别尊称！");
		return;
	}
	if(validateNull(company)){
		alert("对不起，请输入您的公司全称！");
		return;
	}
	if(validateNull(phone)){
		alert("对不起，请输入您的固定电话！");
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
				alert("恭喜，您的咨询已经提交！")
				resetForm();
			}else{
				alert("系统故障，请刷新页面重新提交或者联系管理员！");
			}
		}
	});
}

//function returnPage(baseurl,rootid,catid,offset){
//	window.location = baseurl + "index.php/main/knowledgecity/" + rootid + "/" + catid + "/" + offset;
//}

function resetForm(){
	jQuery("#title").attr("value","");
	jQuery("#company").attr("value","");
	jQuery("#phone").attr("value","");
	jQuery("#content").attr("value","");
}

function validateNull(objectvalue)
{
	if( objectvalue.toString().length == 0 || objectvalue == ""){
		return true;
	}else{
		return false;
	}
}
