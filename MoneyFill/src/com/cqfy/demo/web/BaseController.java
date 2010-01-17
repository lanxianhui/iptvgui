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
	 * ��Controller�����ȡBean
	 * @param name
	 * @return
	 */
	protected Object getBean(String name){
		return ContextLoader.getCurrentWebApplicationContext().getBean(name);
	}
	/**
	 * ��ȡ���ڵ�Context
	 * @return
	 */
	protected ServletContext getContext(){
		return ContextLoader.getCurrentWebApplicationContext().getServletContext();
	}
	/**
	 * ����Ƿ��½
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
	 * ��ȡ����·��
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
