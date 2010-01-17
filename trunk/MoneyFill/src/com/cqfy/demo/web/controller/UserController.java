package com.cqfy.demo.web.controller;

import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

import com.cqfy.demo.business.UserService;
import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.util.ResponseCode.LoginCode;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.PwdForm;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class UserController extends BaseController {

	private UserService userService;

	@Autowired
	public void setUserService(
			@Qualifier(BeanNames.BEAN_SERVICE_USER) UserService userService) {
		this.userService = userService;
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_LISTUSERS, method = RequestMethod.GET)
	public String listUsers(HttpServletRequest request,
			@RequestParam("pageindex") int pageindex, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			PagingInfo page = new PagingInfo(pageindex, 10);
			List<UserForm> forms = this.userService.getAllUsers(page);
			model.addAttribute(PageValue.LIST_USERS, forms);
			return PageValue.PAGE_ADMIN_ACCOUNTMANAGE;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_LOGOUT, method = RequestMethod.GET)
	public String logOut(HttpServletRequest request, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			HttpSession session = request.getSession();
			session.removeAttribute(PageValue.SESSION_USER);
			UserForm form = (UserForm) getBean(BeanNames.BEAN_FORM_USER);
			model.addAttribute(PageValue.INIT_LOGINUSER, form);
			return PageValue.PAGE_LOGIN;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_DELETEUSER)
	public String delUserForm(HttpServletRequest request,
			@RequestParam("id") long id, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			this.userService.deleteUserById(id);
			PagingInfo page = new PagingInfo(0, 10);
			List<UserForm> forms = this.userService.getAllUsers(page);
			model.addAttribute(PageValue.LIST_USERS, forms);
			return PageValue.PAGE_ADMIN_ACCOUNTMANAGE;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_ADDUSERFORM)
	public String addUserForm(HttpServletRequest request, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			UserForm form = new UserForm();
			model.addAttribute(PageValue.INIT_ADDUSER, form);
			return PageValue.PAGE_ADMIN_ACCOUNTADD;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_ADDUSER, method = RequestMethod.POST)
	public String addUser(HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_ADDUSER) UserForm userForm,
			BindingResult result, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			if (result.hasErrors()) {
				return PageValue.PAGE_ADMIN_ACCOUNTADD;
			} else {
				boolean resultCode = this.userService.createUser(userForm);
				if (resultCode) {
					PagingInfo page = new PagingInfo(0, 10);
					List<UserForm> forms = this.userService.getAllUsers(page);
					model.addAttribute(PageValue.LIST_USERS, forms);
					return PageValue.PAGE_ADMIN_ACCOUNTMANAGE;
				} else {
					model.addAttribute(PageValue.MSG_CREATEUSERERROR, userForm
							.getErrorMessage());
					return PageValue.PAGE_ADMIN_ACCOUNTADD;
				}
			}
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_LOGIN_USER, method = RequestMethod.POST)
	public String loginUser(HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_LOGINUSER) UserForm userForm,
			BindingResult result, ModelMap map) {
		if (result.hasErrors()) {
			return PageValue.PAGE_LOGIN;
		} else {
			LoginCode resultCode = this.userService.loginUser(userForm);
			if (resultCode == LoginCode.SUCCESS) {
				// 设置填充用户会话
				HttpSession session = request.getSession();
				session.setAttribute(PageValue.SESSION_USER, userForm);

				if (userForm.getUserSort() == UserSort.SORT_USER) {
					return PageValue.ACTION_USER_INDEX;
				} else {
					return PageValue.ACTION_ADMIN_INDEX;
				}
			} else {
				map.addAttribute(PageValue.MSG_LOGINERROR, userForm
						.getErrorMessage());
				return PageValue.PAGE_LOGIN;
			}
		}
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_CHANGEFORM)
	public String changePassword(HttpServletRequest request,
			@RequestParam("id") long id, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			UserForm userForm = this.userService.readUserById(id);
			PwdForm form = (PwdForm) getBean(BeanNames.BEAN_FORM_PWD);
			form.setUserName(userForm.getUsername());
			form.setOldPassword(userForm.getPassword());
			model.addAttribute(PageValue.INIT_USERPWD, form);
			return PageValue.PAGE_ADMIN_CHANGEPWD;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_CHANGEUSERPWD, method = RequestMethod.POST)
	public String changePassword(HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_USERPWD) PwdForm pwdForm,
			BindingResult result, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			if (result.hasErrors()) {
				return PageValue.PAGE_ADMIN_CHANGEPWD;
			} else {
				boolean resultCode = this.userService.changePassword(pwdForm);
				if (resultCode) {
					PagingInfo page = new PagingInfo(0, 10);
					List<UserForm> forms = this.userService.getAllUsers(page);
					model.addAttribute(PageValue.LIST_USERS, forms);
					return PageValue.PAGE_ADMIN_ACCOUNTMANAGE;
				} else {
					model.addAttribute(PageValue.MSG_CHANGEERROR, pwdForm
							.getErrorMessage());
					return PageValue.PAGE_ADMIN_CHANGEPWD;
				}
			}
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_CHANGEPWD)
	public String modifyPassword(HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_USERPWD) PwdForm pwdForm,
			BindingResult result, ModelMap model) {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			if (result.hasErrors()) {
				return PageValue.PAGE_USER_CHANGEPWD;
			} else {
				// 设置会话数据
				HttpSession session = request.getSession();
				UserForm userForm = (UserForm) session
						.getAttribute(PageValue.SESSION_USER);
				pwdForm.setUserName(userForm.getUsername());

				boolean resultCode = this.userService.modifyPassword(pwdForm);
				if (resultCode) {
					return PageValue.PAGE_USER_PWDSUCCESS;
				} else {
					model.addAttribute(PageValue.MSG_CHANGEERROR, pwdForm
							.getErrorMessage());
					return PageValue.PAGE_USER_CHANGEPWD;
				}
			}
		} else {
			return resultPage;
		}
	}

	// 重定向的系列方法【初始化表单方法】
	@RequestMapping(value = PageValue.ACTION_LOGIN_INDEX)
	public String initLogin(ModelMap model) throws Exception {
		UserForm form = (UserForm) getBean(BeanNames.BEAN_FORM_USER);
		model.addAttribute(PageValue.INIT_LOGINUSER, form);
		return PageValue.PAGE_LOGIN;
	}

	@RequestMapping(value = PageValue.ACTION_ADMIN_INDEX)
	public String initAdmin(HttpServletRequest request, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			return PageValue.PAGE_ADMIN_INDEX;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_INDEX)
	public String initUser(HttpServletRequest request, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			return PageValue.PAGE_USER_INDEX;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_PWDFORM)
	public String initPassword(HttpServletRequest request, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request, model);
		if (resultPage == null) {
			PwdForm pwdForm = (PwdForm) getBean(BeanNames.BEAN_FORM_PWD);
			model.addAttribute(PageValue.INIT_USERPWD, pwdForm);
			return PageValue.PAGE_USER_CHANGEPWD;
		} else {
			return resultPage;
		}
	}

	// 资源相关
	/*
	 * @RequestMapping(value=BeanNames.ACTION_LOAD_CSS,method=RequestMethod.GET)
	 * public String loadCssFiles(){ return "css/site.css"; }
	 */

}
