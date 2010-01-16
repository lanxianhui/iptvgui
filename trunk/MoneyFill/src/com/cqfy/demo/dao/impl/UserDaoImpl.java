package com.cqfy.demo.dao.impl;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Repository;

import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.dao.generic.GenericDAOImpl;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.BeanNames;

@Repository(BeanNames.BEAN_DAO_USER)
@Scope("prototype")
public class UserDaoImpl extends GenericDAOImpl<UserInfo> implements UserDao{
	public UserDaoImpl(){
		super(UserInfo.class);
	}
}
