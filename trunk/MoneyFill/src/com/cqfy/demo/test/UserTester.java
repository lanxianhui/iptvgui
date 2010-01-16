package com.cqfy.demo.test;

import junit.framework.TestCase;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.web.form.UserForm;

public class UserTester extends TestCase{
	UserDao userDao = (UserDao)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_DAO_USER);
	UserService userService = (UserService)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_SERVICE_USER);
	public void testUserCreate(){
		UserInfo user = (UserInfo)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_MODEL_USER);
		user.setUserName("Hello");
		user.setPassword("111111");
		user.setUserSort(UserSort.SORT_ADMIN);
		//userDao.save(user);
	}
	
	public void testReference(){
		UserForm form = (UserForm)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_FORM_USER);
		System.out.println(form.getId());
		userService.loginUser(form);
		System.out.println(form.getId());
	}
}
