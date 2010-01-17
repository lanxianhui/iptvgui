package com.cqfy.demo.business.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.PwdForm;
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
		String checkUserQuery = "username=?";
		Object[] params = {user.getUsername()};
		List<UserInfo> users = userDao.find(checkUserQuery,params,0,0);
		if( users.size() == 0){
			user.setErrorMessage("对不起，该帐号不存在！");
			return LoginCode.USERNAME_NOT_EXIST;
		}else{
			UserInfo userModel = users.get(0);
			if( userModel.getPassword().trim().equals(user.getPassword().trim())){
				user.setId(userModel.getId());
				user.setUserSort(userModel.getUserSort());
				return LoginCode.SUCCESS;
			}else{
				user.setErrorMessage("对不起，您输入的密码错误！");
				return LoginCode.PASSWORD_ERROR;
			}
		}
	}

	@Override
	public boolean modifyPassword(PwdForm user) {
		String checkUserQuery = "username=? and password=?";
		Object[] params = {user.getUserName(),user.getOldPassword()};
		List<UserInfo> users = userDao.find(checkUserQuery, params, 0, 0);
		if( users.size() == 0 ){
			user.setErrorMessage("对不起，新密码输入错误！");
			return false;
		}else{
			UserInfo userModel = users.get(0);
			userModel.setPassword(user.getNewPassword());
			userDao.update(userModel);
			return true;
		}
	}
}
