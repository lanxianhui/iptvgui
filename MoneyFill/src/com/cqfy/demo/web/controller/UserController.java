package com.cqfy.demo.web.controller;

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
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class UserController extends BaseController{
	
	private UserService userService;
	
	@Autowired
	public void setUserService(@Qualifier(BeanNames.BEAN_SERVICE_USER) UserService userService){
		this.userService = userService;
	}
	
	@RequestMapping(value="/loginuser",method=RequestMethod.POST)
	public String loginUser(@Valid @ModelAttribute("loginUser") UserForm userForm, BindingResult result){
		System.out.println("Hello");
		if(result.hasErrors()){
			return BeanNames.PAGE_LOGIN;
		}else{
			UserForm resultForm = userService.loginUser(userForm);
			System.out.println(userForm.getUsername());
			System.err.println(userForm.getUsername());
			if(resultForm.isLoginSuccess()){
				if(resultForm.getUserSort() == UserSort.SORT_USER){
					return BeanNames.ACTION_USER_INDEX;
				}else{
					return BeanNames.ACTION_ADMIN_INDEX;
				}
			}else{
				return BeanNames.PAGE_LOGIN;
			}
		}
	}
	
	@RequestMapping(value="/login")
	public String initUser(ModelMap model) throws Exception{
		UserForm form = (UserForm)getBean(BeanNames.BEAN_FORM_USER);
		model.addAttribute("loginUser",form);
		return BeanNames.PAGE_LOGIN;
	}
}
