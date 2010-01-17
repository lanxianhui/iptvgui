package com.cqfy.demo.util;

public class PageValue {
	/**
	 * ҳ���嵥
	 */
	public static final String PAGE_LOGIN = "/login.jsp";
	
	public static final String PAGE_ADMIN_INDEX = "/admin/index.jsp";
	
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
	 * ҳ���Ӧ��Action�嵥
	 */
	public static final String ACTION_LOGIN_INDEX = "/login.service";
	public static final String ACTION_LOGIN_USER = "/loginuser.service";
	
	public static final String ACTION_ADMIN_INDEX = "/adminindex.service";
	
	public static final String ACTION_USER_INDEX = "/userindex.service";
	public static final String ACTION_USER_CARDFORM = "/usercard.service";
	public static final String ACTION_USER_ADDCARD = "/cardadd.service";
	public static final String ACTION_USER_BINDFORM = "/userbind.service";
	public static final String ACTION_USER_LISTORDERS = "/userorders.service";
	public static final String ACTION_USER_ADDORDER = "/addorder.service";
	public static final String ACTION_USER_LISTPRICE = "/userprice.service";
	public static final String ACTION_USER_PWDFORM = "/userpwd.service";
	public static final String ACTION_USER_CHANGEPWD = "/changepwd.service";
	/**
	 * Session �����ŵ�UserForm
	 */
	public static final String SESSION_USER = "userForm";
	/**
	 * ��ʼ������ģ��
	 */
	public static final String INIT_LOGINUSER = "loginUser";
	public static final String INIT_USERBIND = "bindUser";
	public static final String INIT_USERORDER= "orderUser";
	public static final String INIT_USERPWD = "userPwd";
	
	public static final String MSG_LOGINERROR = "loginErrorMessage";
}