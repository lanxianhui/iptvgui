package com.cqfy.demo.test;

import junit.framework.TestCase;

import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;

public class UserTester extends TestCase{
	UserDao userDao = (UserDao)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_DAO_USER);
	public void testUserCreate(){
		UserInfo user = (UserInfo)CustomBeanFactory.getCustomeBean(BeanNames.BEAN_MODEL_USER);
		user.setUserName("Hello");
		user.setPassword("111111");
		user.setUserSort(UserSort.SORT_ADMIN);
		userDao.save(user);
	}
}
