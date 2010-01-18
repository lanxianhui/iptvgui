package com.cqfy.demo.web.form;

import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_STATUS)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
public class StatusForm {
	
	private long id;
	private OrderStatus status;
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	public OrderStatus getStatus() {
		return status;
	}
	public void setStatus(OrderStatus status) {
		this.status = status;
	}
}
