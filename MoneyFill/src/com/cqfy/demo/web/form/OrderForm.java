package com.cqfy.demo.web.form;

import java.io.Serializable;
import java.math.BigDecimal;

import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.format.annotation.NumberFormat;
import org.springframework.format.annotation.NumberFormat.Style;
import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_ORDER)
public class OrderForm implements Serializable{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 7348416894495191580L;
	private long id;
	
	private String lineNumber;
	@NotEmpty(message = "对不起，请输入卡号，卡号不能为空！")
	@Size(max = 200)
	private String cardNumber;
	@NotEmpty(message = "对不起，请输入您要充值的金额！")
	@NumberFormat(style = Style.CURRENCY)
	private BigDecimal price;
	
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
	public BigDecimal getPrice() {
		return price;
	}
	public void setPrice(BigDecimal price) {
		this.price = price;
	}
}
