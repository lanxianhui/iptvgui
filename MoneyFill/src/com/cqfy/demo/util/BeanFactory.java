package com.cqfy.demo.util;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.FileSystemXmlApplicationContext;

public class BeanFactory {
	public static ApplicationContext context =new FileSystemXmlApplicationContext
	("WebContent/WEB-INF/spring-config.xml") ;

	public static Object getBean(String beanName) {
		return context.getBean(beanName);
	}
}
