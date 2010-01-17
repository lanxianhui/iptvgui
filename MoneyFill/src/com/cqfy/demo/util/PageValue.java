package com.cqfy.demo.util;

public class PageValue {
	/**
	 * 页面清单
	 */
	public static final String PAGE_LOGIN = "/login.jsp";
	
	public static final String PAGE_ADMIN_INDEX = "/admin/index.jsp";
	public static final String PAGE_ADMIN_ACCOUNTMANAGE = "/admin/accountmanage.jsp";
	public static final String PAGE_ADMIN_ACCOUNTADD = "/admin/accountadd.jsp";
	public static final String PAGE_ADMIN_CHANGEPWD = "/admin/changepwd.jsp";
	
	public static final String PAGE_USER_INDEX = "/user/index.jsp";
	public static final String PAGE_USER_ORDERFORM = "/user/fillcard.jsp";
	public static final String PAGE_USER_CARDFORM = "/user/bindcard.jsp";
	public static final String PAGE_USER_LISTORDERS = "/user/listorders.jsp";
	public static final String PAGE_USER_LISTPRICE = "/user/listprice.jsp";
	public static final String PAGE_USER_BINDSUCCESS = "/user/bindsuccess.jsp";
	public static final String PAGE_USER_ORDERSUCCESS = "/user/ordersuccess.jsp";
	public static final String PAGE_USER_CHANGEPWD = "/user/changepwd.jsp";
	public static final String PAGE_USER_PWDSUCCESS = "/user/pwdsuccess.jsp";
	/**
	 * 页面对应的Action清单
	 */
	public static final String ACTION_LOGIN_INDEX = "/login.service";
	public static final String ACTION_LOGIN_USER = "/loginuser.service";
	
	public static final String ACTION_ADMIN_INDEX = "/adminindex.service";
	public static final String ACTION_ADMIN_LISTUSERS = "/listuser.service";
	public static final String ACTION_ADMIN_ADDUSER = "/adduser.service";
	public static final String ACTION_ADMIN_ADDUSERFORM = "/adduserform.service";
	public static final String ACTION_ADMIN_DELETEUSER = "/deluser.service";
	public static final String ACTION_ADMIN_CHANGEFORM = "/changepwdform.service";
	public static final String ACTION_ADMIN_CHANGEUSERPWD = "/changeuserpwd.service";
	
	public static final String ACTION_USER_INDEX = "/userindex.service";
	public static final String ACTION_USER_CARDFORM = "/usercard.service";
	public static final String ACTION_USER_ADDCARD = "/cardadd.service";
	public static final String ACTION_USER_BINDFORM = "/userbind.service";
	public static final String ACTION_USER_LISTORDERS = "/userorders.service";
	public static final String ACTION_USER_ADDORDER = "/addorder.service";
	public static final String ACTION_USER_LISTPRICE = "/userprice.service";
	public static final String ACTION_USER_PWDFORM = "/userpwd.service";
	public static final String ACTION_USER_CHANGEPWD = "/changepwd.service";
	public static final String ACTION_USER_LOGOUT = "/logout.service";
	/**
	 * Session 里面存放的UserForm
	 */
	public static final String SESSION_USER = "userForm";
	/**
	 * 初始化表单模型
	 */
	public static final String INIT_LOGINUSER = "loginUser";
	public static final String INIT_ADDUSER = "addUser";
	public static final String INIT_USERBIND = "bindUser";
	public static final String INIT_USERORDER= "orderUser";
	public static final String INIT_USERPWD = "userPwd";
	public static final String LIST_ORDERS = "orderlist";
	public static final String LIST_CARD = "cardlist";
	public static final String LIST_USERS = "userlist";
	public static final String SUCCESS_BIND = "cardSuccess";
	public static final String SUCCESS_ORDER = "orderSuccess";
	
	public static final String MSG_LOGINERROR = "loginErrorMessage";
	public static final String MSG_CHANGEERROR = "changeErrorMessage";
	public static final String MSG_CREATEUSERERROR = "createUserErrorMessage";
}
