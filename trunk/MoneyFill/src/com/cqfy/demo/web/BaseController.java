package com.cqfy.demo.web;

import javax.servlet.ServletContext;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.springframework.ui.ModelMap;
import org.springframework.web.context.ContextLoader;

import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.web.form.UserForm;

public abstract class BaseController{
	
	private static final long serialVersionUID = 0L;
	/**
	 * 从Controller里面获取Bean
	 * @param name
	 * @return
	 */
	protected Object getBean(String name){
		return ContextLoader.getCurrentWebApplicationContext().getBean(name);
	}
	/**
	 * 获取现在的Context
	 * @return
	 */
	protected ServletContext getContext(){
		return ContextLoader.getCurrentWebApplicationContext().getServletContext();
	}
	/**
	 * 检测是否登陆
	 * @param request
	 * @return
	 */
	protected String checkLogin(HttpServletRequest request,ModelMap model){
		HttpSession session = request.getSession();
		if(session.getAttribute(PageValue.SESSION_USER) == null){
			UserForm form = (UserForm)getBean(BeanNames.BEAN_FORM_USER);
			model.addAttribute(PageValue.INIT_LOGINUSER,form);
			return PageValue.PAGE_LOGIN;
		}else{
			return null;
		}
	}
	/**
	 * 获取物理路径
	 * @param path
	 * @return
	 * @throws Exception
	 */
	protected String getPhysicalPath(String path) throws Exception {
		if( !path.startsWith("/")){
			System.err.println("Path format is not valid!");
			throw new Exception();
		}else{
			StringBuffer physicalPath = new StringBuffer(ContextLoader.getCurrentWebApplicationContext().getServletContext().getRealPath(path).replace("\\", "/"));
			return physicalPath.toString();
		}
	}

	protected String getServerPhysicalPath() throws Exception{
		return getPhysicalPath("/");
	}
}
