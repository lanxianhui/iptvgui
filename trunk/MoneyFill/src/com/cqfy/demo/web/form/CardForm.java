package com.cqfy.demo.web.form;

import java.io.Serializable;

import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_CARD)
public class CardForm implements Serializable{
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	/**
	 * 
	 */
	private static final long serialVersionUID = 3143599272215670934L;
	private long id;
	@NotEmpty(message = "对不起，请输入充值卡号！")
	@Size(max = 200)
	private String cardNumber;
	@NotEmpty(message = "对不起，请输入手机号码！")
	@Size(max = 200)
	private String mobileNumber;
	private UserForm userForm;
	public String getCardNumber() {
		return cardNumber;
	}
	public void setCardNumber(String cardNumber) {
		this.cardNumber = cardNumber;
	}
	public String getMobileNumber() {
		return mobileNumber;
	}
	public void setMobileNumber(String mobileNumber) {
		this.mobileNumber = mobileNumber;
	}
	public UserForm getUserForm() {
		return userForm;
	}
	public void setUserForm(UserForm userForm) {
		this.userForm = userForm;
	}
}
