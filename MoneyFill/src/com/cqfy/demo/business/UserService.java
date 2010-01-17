package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.PwdForm;
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
	boolean modifyPassword(PwdForm user);
	/**
	 * ��ҳ��ȡ���е��ʺ�
	 * @param page
	 * @return
	 */
	List<UserForm> getAllUsers(PagingInfo page);
	/**
	 * �����û�ID��ȡ�û���Ϣ
	 * @param userId
	 * @return
	 */
	UserForm readUserById(long userId);
	/**
	 * ɾ��һ���ʺ���Ϣ
	 * @param userId
	 * @return
	 */
	boolean deleteUserById(long userId);
	/**
	 * ����һ�����˻�
	 * @param userForm
	 * @return
	 */
	boolean createUser(UserForm userForm);
	/**
	 * ֱ���޸��û�������
	 * @param user
	 * @return
	 */
	boolean changePassword(PwdForm user);
}
