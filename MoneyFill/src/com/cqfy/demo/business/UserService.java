package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.PwdForm;
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
	boolean modifyPassword(PwdForm user);
	/**
	 * 分页获取所有的帐号
	 * @param page
	 * @return
	 */
	List<UserForm> getAllUsers(PagingInfo page);
	/**
	 * 根据用户ID获取用户信息
	 * @param userId
	 * @return
	 */
	UserForm readUserById(long userId);
	/**
	 * 删除一个帐号信息
	 * @param userId
	 * @return
	 */
	boolean deleteUserById(long userId);
	/**
	 * 创建一个新账户
	 * @param userForm
	 * @return
	 */
	boolean createUser(UserForm userForm);
	/**
	 * 直接修改用户的密码
	 * @param user
	 * @return
	 */
	boolean changePassword(PwdForm user);
}
