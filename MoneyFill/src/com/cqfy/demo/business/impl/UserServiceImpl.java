package com.cqfy.demo.business.impl;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.UserInfo;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.form.PwdForm;
import com.cqfy.demo.web.form.UserForm;

/**
 * 用户业务接口实现
 * 
 * @author LangYu
 * 
 */
@Service(BeanNames.BEAN_SERVICE_USER)
@Scope("singleton")
public class UserServiceImpl implements UserService {

	private UserDao userDao;
	private UserInfo userInfo;

	@Autowired
	public void setUserDao(@Qualifier(BeanNames.BEAN_DAO_USER) UserDao userDao) {
		this.userDao = userDao;
	}

	@Autowired
	public void setUserInfo(
			@Qualifier(BeanNames.BEAN_MODEL_USER) UserInfo userInfo) {
		this.userInfo = userInfo;
	}

	@Override
	public LoginCode loginUser(UserForm user) {
		String checkUserQuery = "username=?";
		Object[] params = { user.getUsername() };
		List<UserInfo> users = userDao.find(checkUserQuery, params, 0, 0);
		if (users.size() == 0) {
			user.setErrorMessage("对不起，该帐号不存在！");
			return LoginCode.USERNAME_NOT_EXIST;
		} else {
			UserInfo userModel = users.get(0);
			if (userModel.getPassword().trim()
					.equals(user.getPassword().trim())) {
				user.setId(userModel.getId());
				user.setUserSort(userModel.getUserSort());
				return LoginCode.SUCCESS;
			} else {
				user.setErrorMessage("对不起，您输入的密码错误！");
				return LoginCode.PASSWORD_ERROR;
			}
		}
	}

	@Override
	public boolean changePassword(PwdForm user) {
		try {
			String checkUserQuery = "username=? and password=?";
			Object[] params = { user.getUserName(), user.getOldPassword() };
			List<UserInfo> users = userDao.find(checkUserQuery, params, 0, 0);
			UserInfo userModel = users.get(0);
			userModel.setPassword(user.getNewPassword());
			userDao.update(userModel);
			return true;
		} catch (Exception ex) {
			ex.printStackTrace();
			user.setErrorMessage("对不起，系统故障不能修改！");
			return false;
		}
	}

	@Override
	public boolean modifyPassword(PwdForm user) {
		String checkUserQuery = "username=? and password=?";
		Object[] params = { user.getUserName(), user.getOldPassword() };
		List<UserInfo> users = userDao.find(checkUserQuery, params, 0, 0);
		if (users.size() == 0) {
			user.setErrorMessage("对不起，原密码输入错误！");
			return false;
		} else {
			UserInfo userModel = users.get(0);
			userModel.setPassword(user.getNewPassword());
			userDao.update(userModel);
			return true;
		}
	}

	@Override
	@SuppressWarnings("unchecked")
	public List<UserForm> getAllUsers(PagingInfo page) {
		String NSQL = "select * from fm_user order by id desc";
		Object[] params = {};
		List<UserInfo> users = this.userDao.queryNativeSQL(NSQL, params, (page
				.getPageIndex() - 1)
				* page.getPageSize(), page.getPageSize());
		List<UserForm> forms = new ArrayList<UserForm>();
		for (UserInfo user : users) {
			UserForm form = new UserForm();
			fillUserForm(user, form);
			forms.add(form);
		}
		return forms;
	}

	private void fillUserForm(UserInfo user, UserForm userForm) {
		userForm.setId(user.getId());
		userForm.setUsername(user.getUserName());
		userForm.setUserSort(user.getUserSort());
	}

	@Override
	public boolean deleteUserById(long userId) {
		try {
			this.userDao.remove(userId);
			String NSQL = "delete from db_card where userid=" + userId;
			this.userDao.executeNativeSQL(NSQL);
			NSQL = "delete from db_order where userid=" + userId;
			this.userDao.executeNativeSQL(NSQL);
			return true;
		} catch (Exception ex) {
			ex.printStackTrace();
			return false;
		}
	}

	@Override
	public UserForm readUserById(long userId) {
		UserForm form = new UserForm();
		UserInfo user = this.userDao.read(userId);
		form.setUsername(user.getUserName());
		form.setPassword(user.getPassword());
		form.setUserSort(user.getUserSort());
		//fillUserForm(user, form);
		return form;
	}

	@Override
	public boolean createUser(UserForm userForm) {
		try {
			String checkUserQuery = "username=?";
			Object[] params = { userForm.getUsername() };
			List<UserInfo> users = userDao.find(checkUserQuery, params, 0, 0);
			if (users.size() != 0) {
				userForm.setErrorMessage("对不起，该帐号已经存在！");
				return false;
			}
			userInfo.setUserName(userForm.getUsername());
			userInfo.setPassword(userForm.getPassword());
			userInfo.setUserSort(userForm.getUserSort());
			this.userDao.save(userInfo);
			return true;
		} catch (Exception ex) {
			ex.printStackTrace();
			return false;
		}
	}

}
