package com.cqfy.demo.test;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.FileSystemXmlApplicationContext;

public class CustomBeanFactory {

	public static ApplicationContext context =new FileSystemXmlApplicationContext
	("WebContent/WEB-INF/spring-config.xml") ;

	public static Object getCustomeBean(String beanName) {
		return context.getBean(beanName);
	}
}