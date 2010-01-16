package com.cqfy.demo.business.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.UserForm;
/**
 * 用户业务接口实现
 * @author LangYu
 *
 */
@Service(BeanNames.BEAN_SERVICE_USER)
@Scope("singleton")
public class UserServiceImpl implements UserService {
	
	private UserDao userDao;
	
	@Autowired
	public void setUserDao(@Qualifier(BeanNames.BEAN_DAO_USER) UserDao userDao){
		this.userDao = userDao;
	}

	@Override
	public LoginCode loginUser(UserForm user) {
		// TODO Auto-generated method stub
		user.setId(12);
		return null;
	}

	@Override
	public boolean modifyPassword(UserInfo user) {
		//TODO 
		userDao.update(user);
		return false;
	}
}
