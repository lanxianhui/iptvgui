package com.cqfy.demo.web.form;

import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_USER)
@Scope("prototype")
public class UserForm {
	@NotEmpty(message="对不起，登陆帐号不可以为空！")
	@Size(max = 200)
	private String username;
	@NotEmpty(message="对不起，请输入登陆密码！")
	@Size(max = 200)
	private String password;
	
	private UserSort userSort;
	private boolean loginSuccess;
	private String errorMessage;
	
	public UserSort getUserSort() {
		return userSort;
	}
	public void setUserSort(UserSort userSort) {
		this.userSort = userSort;
	}
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public boolean isLoginSuccess() {
		return loginSuccess;
	}
	public void setLoginSuccess(boolean loginSuccess) {
		this.loginSuccess = loginSuccess;
	}
	public String getErrorMessage() {
		return errorMessage;
	}
	public void setErrorMessage(String errorMessage) {
		this.errorMessage = errorMessage;
	}
}
