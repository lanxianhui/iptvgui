package com.cqfy.demo.util;

public class PageValue {
	/**
	 * 页面清单
	 */
	public static final String PAGE_LOGIN = "/login.jsp";
	
	public static final String PAGE_ADMIN_INDEX = "/admin/index.jsp";
	
	public static final String PAGE_USER_INDEX = "/user/index.jsp";
	public static final String PAGE_USER_FILLCARD = "/user/fillcard.jsp";
	public static final String PAGE_USER_BINDCARD = "/user/bindcard.jsp";
	public static final String PAGE_USER_LISTORDERS = "/user/listorders.jsp";
	public static final String PAGE_USER_LISTPRICE = "/user/listprice.jsp";
	/**
	 * 页面对应的Action清单
	 */
	public static final String ACTION_LOGIN_INDEX = "/login.service";
	public static final String ACTION_LOGIN_USER = "/loginuser.service";
	
	public static final String ACTION_ADMIN_INDEX = "/adminindex.service";
	
	public static final String ACTION_USER_INDEX = "/userindex.service";
	public static final String ACTION_USER_FILLCARD = "/usercard.service";
	public static final String ACTION_USER_BINDCARD = "/userbind.service";
	public static final String ACTION_USER_LISTORDERS = "/userorders.service";
	public static final String ACTION_USER_LISTPRICE = "/userprice.service";
	/**
	 * Session 里面存放的UserForm
	 */
	public static final String SESSION_USER = "userForm";
	/**
	 * 初始化表单模型
	 */
	public static final String INIT_LOGINUSER = "loginUser";
	public static final String INIT_USERBIND = "bindUser";
	public static final String INIT_USERCARD= "cardUser";
}
