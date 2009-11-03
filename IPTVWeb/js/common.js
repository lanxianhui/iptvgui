function activePanel(objectId)
{
	$("div[class]").css("display","none");
	$(objectId).css("display","block");
}

function backMain()
{
	activePanel("#v_main");
}

var connecttype = 1;

function changeRadio(index)
{
	switch(index){
		case 1:window.location = "NetworkSettings.html";break;
		case 2:window.location = "DhcpSettings.html";break;
		case 3:window.location = "LanSettings.html";break;
		case 4:window.location = "DualModeSettings.html";break;
	}
}

function showMessage(index)
{
	switch(index)
	{
		
	}
}

function ajaxcgi()
{
	$.ajax({
		   type:"POST",
		   url:"http://localhost/cgi-bin/hello.cgi",
		   success:function(data,textStatus){
			   $("#testcgi").html(data);
		   }
		   });
}
function ipfilter(ipaddress){
	if(ipaddress.length == 0 || ipaddress == ""){
		return "0";
	}else{
		return ipaddress;
	}
}

function submitUpGrade(){
	var ipaddress = ipfilter($("#ipaddress1").attr("value")) + "." + ipfilter($("#ipaddress2").attr("value")) + "." 
	+ ipfilter($("#ipaddress3").attr("value")) + "." + ipfilter($("#ipaddress4").attr("value"));
	$("#ipaddress").attr("value",ipaddress);
	submitForm("f_upgrade");
}

function submitNetwork(index){
	switch(index){
		case 1:submitForm("f_pppoe");break;
		case 2:submitForm("f_dhcp");break;
		case 3:{
			var ip = ipfilter($("#lanadd11").attr("value")) + "." + ipfilter($("#lanadd12").attr("value")) + "." + ipfilter($("#lanadd13").attr("value")) + "." + ipfilter($("#lanadd14").attr("value"));
			var gateway = ipfilter($("#lanadd21").attr("value")) + "." + ipfilter($("#lanadd22").attr("value")) + "." + ipfilter($("#lanadd23").attr("value")) + "." + ipfilter($("#lanadd24").attr("value"));
			var netmask = ipfilter($("#lanadd31").attr("value")) + "." + ipfilter($("#lanadd32").attr("value")) + "." + ipfilter($("#lanadd33").attr("value")) + "." + ipfilter($("#lanadd34").attr("value"));
			var dns = ipfilter($("#lanadd41").attr("value")) + "." + ipfilter($("#lanadd42").attr("value")) + "." + ipfilter($("#lanadd43").attr("value")) + "." + ipfilter($("#lanadd44").attr("value"));
			$("#ip").attr("value",ip);
			$("#gateway").attr("value",gateway);
			$("#netmask").attr("value",netmask);
			$("#dns").attr("value",dns);
			submitForm("f_lan");
			break;
		}
		case 4:submitForm("f_dualmode");break;
	}
}

var flag = true;

function blurMsg(object){
	var text = jQuery(object).attr("value");
	var value = Number(text);
	if( value <= 0 || value > 255){
		$("#msgError").html("IP地址的格式非法！");
		$("#msgError").fadeIn("slow");
		flag = false;
	}else{
		$("#msgError").fadeOut("slow",function(){
			$("#msgError").html("对不起，请将信息填写完整！");
			flag = true;
		});
	}
}

function cusOnlyNum() 
{
	if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39)) 
	if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105))) 
	event.returnValue=false; 
} 

function submitAccount(objectid){
	var result = true;
	if($("#accountname").attr("value") == ""){
		$("#msgError").fadeIn("slow");
		result = false;
	}
	if($("#password").attr("value") == ""){
		//$("#msgError").css("display","inline");
		$("#msgError").fadeIn("slow");
			result = false;
	}else{
		if( result == true ){
			submitForm(objectid);
		}
	}
}

function submitForm(objectid)
{
	$("#" + objectid).submit();
}