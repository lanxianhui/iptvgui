package com.cqfy.demo.web.form;

import java.io.Serializable;

import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_USER)
@Scope("session")
public class UserForm implements Serializable{
	/**
	 * 
	 */
	private static final long serialVersionUID = 2952837484983370777L;
	
	private long id;
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	@NotEmpty(message="对不起，登陆帐号不可以为空！")
	@Size(max = 200)
	private String username;
	@NotEmpty(message="对不起，请输入登陆密码！")
	@Size(max = 200)
	private String password;
	
	private UserSort userSort;
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
	public String getErrorMessage() {
		return errorMessage;
	}
	public void setErrorMessage(String errorMessage) {
		this.errorMessage = errorMessage;
	}
}
