package com.cqfy.demo.business;

import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.UserForm;

/**
 * 用户业务接口
 * @author LangYu
 * 
 */
public interface UserService {
	/**
	 * 用户登陆
	 * @param username
	 * @param password
	 * @return
	 */
	LoginCode loginUser(UserForm user);
	/**
	 * 修改用户密码
	 * @return
	 */
	boolean modifyPassword(UserInfo user);
}
