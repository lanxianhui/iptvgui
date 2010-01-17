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
	
	@RequestMapping(value=BeanNames.ACTION_LOGIN_USER,method=RequestMethod.POST)
	public String loginUser(HttpServletRequest request,@Valid @ModelAttribute("loginUser") UserForm userForm, BindingResult result){
		if(result.hasErrors()){
			return BeanNames.PAGE_LOGIN;
		}else{
			LoginCode resultCode = this.userService.loginUser(userForm);
			userForm.setUserSort(UserSort.SORT_ADMIN);
			resultCode = LoginCode.SUCCESS;
			if(resultCode == LoginCode.SUCCESS){
				// 设置会话
				HttpSession session = request.getSession();
				session.setAttribute("userFormBean",userForm);
				
				if(userForm.getUserSort() == UserSort.SORT_USER){
					return BeanNames.ACTION_USER_INDEX;
				}else{
					return BeanNames.ACTION_ADMIN_INDEX;
				}
			}else{
				System.out.println(userForm.getErrorMessage());
				return BeanNames.PAGE_LOGIN;
			}
		}
	}
	//重定向的系列方法【初始化表单方法】
	@RequestMapping(value=BeanNames.ACTION_LOGIN_INDEX)
	public String initLogin(ModelMap model) throws Exception{
		UserForm form = (UserForm)getBean(BeanNames.BEAN_FORM_USER);
		model.addAttribute("loginUser",form);
		return BeanNames.PAGE_LOGIN;
	}
	
	@RequestMapping(value=BeanNames.ACTION_ADMIN_INDEX)
	public String initAdmin(ModelMap model) throws Exception{
		return BeanNames.PAGE_ADMIN_INDEX;
	}
	
	@RequestMapping(value=BeanNames.ACTION_USER_INDEX)
	public String initUser(ModelMap model) throws Exception{
		return BeanNames.PAGE_USER_INDEX;
	}
	
	
}
