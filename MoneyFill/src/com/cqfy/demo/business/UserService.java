package com.cqfy.demo.business;

import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.UserForm;

/**
 * �û�ҵ��ӿ�
 * @author LangYu
 * 
 */
public interface UserService {
	/**
	 * �û���½
	 * @param username
	 * @param password
	 * @return
	 */
	LoginCode loginUser(UserForm user);
	/**
	 * �޸��û�����
	 * @return
	 */
	boolean modifyPassword(UserInfo user);
}
