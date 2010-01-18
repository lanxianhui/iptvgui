package com.cqfy.demo.web.form;

import java.io.Serializable;
import java.text.SimpleDateFormat;
import java.util.Date;

import javax.validation.constraints.Pattern;
import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.OrderUtil;

@Component(BeanNames.BEAN_FORM_ORDER)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
public class OrderForm implements Serializable{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 7348416894495191580L;
	private long id;
	
	private String lineNumber;
	@NotEmpty(message = "请输入卡号，卡号不能为空！")
	@Size(max = 200)
	private String cardNumber;
	@NotEmpty(message = "请输入充值金额！")
	@Pattern(regexp="\\d*\\.\\d{2}| ",message="货币格式输入错误！")
	private String price;
	
	private OrderStatus status;
	
	private String errorMessage;
	
	private String username;
	
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	@SuppressWarnings("unused")
	private String statusString;
	
	public String getStatusString() {
		return OrderUtil.getOrderStatus(this.status);
	}
	public void setStatusString(String statusString) {
		this.statusString = statusString;
	}
	private Date createTime;
	
	public String getCreateTime() {
		SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd hh:mm");
		return format.format(this.createTime);
	}
	public void setCreateTime(Date createTime) {
		this.createTime = createTime;
	}
	public OrderStatus getStatus() {
		return status;
	}
	public void setStatus(OrderStatus status) {
		this.status = status;
	}
	public UserForm getUserForm() {
		return userForm;
	}
	public void setUserForm(UserForm userForm) {
		this.userForm = userForm;
	}
	private UserForm userForm;
	
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	public String getLineNumber() {
		return lineNumber;
	}
	public void setLineNumber(String lineNumber) {
		this.lineNumber = lineNumber;
	}
	public String getCardNumber() {
		return cardNumber;
	}
	public void setCardNumber(String cardNumber) {
		this.cardNumber = cardNumber;
	}
	public String getPrice() {
		return price;
	}
	public void setPrice(String price) {
		this.price = price;
	}
	public String getErrorMessage() {
		return errorMessage;
	}
	public void setErrorMessage(String errorMessage) {
		this.errorMessage = errorMessage;
	}
}
