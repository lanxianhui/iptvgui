package com.cqfy.demo.web.controller;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class UserController extends BaseController{
	
	private UserService userService;
	
	@Autowired
	public void setUserService(@Qualifier(BeanNames.BEAN_SERVICE_USER) UserService userService){
		this.userService = userService;
	}
	
	@RequestMapping(value=PageValue.ACTION_LOGIN_USER,method=RequestMethod.POST)
	public String loginUser(HttpServletRequest request,@Valid @ModelAttribute(PageValue.INIT_LOGINUSER) UserForm userForm,BindingResult result, ModelMap map){
		if(result.hasErrors()){
			return PageValue.PAGE_LOGIN;
		}else{
			LoginCode resultCode = this.userService.loginUser(userForm);
			if(resultCode == LoginCode.SUCCESS){
				// 设置填充用户会话
				HttpSession session = request.getSession();
				session.setAttribute(PageValue.SESSION_USER,userForm);
				
				if(userForm.getUserSort() == UserSort.SORT_USER){
					return PageValue.ACTION_USER_INDEX;
				}else{
					return PageValue.ACTION_ADMIN_INDEX;
				}
			}else{
				map.addAttribute(PageValue.MSG_LOGINERROR, userForm.getErrorMessage());
				return PageValue.PAGE_LOGIN;
			}
		}
	}
	//重定向的系列方法【初始化表单方法】
	@RequestMapping(value=PageValue.ACTION_LOGIN_INDEX)
	public String initLogin(ModelMap model) throws Exception{
		UserForm form = (UserForm)getBean(BeanNames.BEAN_FORM_USER);
		model.addAttribute(PageValue.INIT_LOGINUSER,form);
		return PageValue.PAGE_LOGIN;
	}
	
	@RequestMapping(value=PageValue.ACTION_ADMIN_INDEX)
	public String initAdmin(ModelMap model) throws Exception{
		return PageValue.PAGE_ADMIN_INDEX;
	}
	
	@RequestMapping(value=PageValue.ACTION_USER_INDEX)
	public String initUser(ModelMap model) throws Exception{
		return PageValue.PAGE_USER_INDEX;
	}
	
	
	//资源相关
	/*@RequestMapping(value=BeanNames.ACTION_LOAD_CSS,method=RequestMethod.GET)
	public String loadCssFiles(){
		return "css/site.css";
	}*/
	
	
}
