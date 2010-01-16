package com.cqfy.demo.web;

import javax.servlet.ServletContext;

import org.springframework.web.context.ContextLoader;
import org.springframework.web.servlet.mvc.AbstractController;

public abstract class BaseController{
	
	private static final long serialVersionUID = 0L;
	/**
	 * 从Controller里面获取Bean
	 * @param name
	 * @return
	 */
	public Object getBean(String name){
		return ContextLoader.getCurrentWebApplicationContext().getBean(name);
	}
	/**
	 * 获取现在的Context
	 * @return
	 */
	public ServletContext getContext(){
		return ContextLoader.getCurrentWebApplicationContext().getServletContext();
	}
	/**
	 * 获取物理路径
	 * @param path
	 * @return
	 * @throws Exception
	 */
	public String getPhysicalPath(String path) throws Exception {
		if( !path.startsWith("/")){
			System.err.println("Path format is not valid!");
			throw new Exception();
		}else{
			StringBuffer physicalPath = new StringBuffer(ContextLoader.getCurrentWebApplicationContext().getServletContext().getRealPath(path).replace("\\", "/"));
			return physicalPath.toString();
		}
	}

	public String getServerPhysicalPath() throws Exception{
		return getPhysicalPath("/");
	}
}
