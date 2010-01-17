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

import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_CARD)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
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
	@Pattern(regexp="\\d{11}| ",message="格式错误，请输入11位手机号！")
	private String mobileNumber;
	private Date createTime;
	public String getCreateTime() {
		SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd hh:mm");
		return format.format(createTime);
	}
	public void setCreateTime(Date createTime) {
		this.createTime = createTime;
	}
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
