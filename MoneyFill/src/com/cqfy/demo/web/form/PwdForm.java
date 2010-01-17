package com.cqfy.demo.web.form;

import javax.validation.constraints.Size;

import org.hibernate.validator.constraints.NotEmpty;
import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_PWD)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
public class PwdForm {
	private String userName;
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getOldPassword() {
		return oldPassword;
	}
	public void setOldPassword(String oldPassword) {
		this.oldPassword = oldPassword;
	}
	public String getNewPassword() {
		return newPassword;
	}
	public void setNewPassword(String newPassword) {
		this.newPassword = newPassword;
	}
	@NotEmpty(message = "对不起，请输入原来的密码！")
	@Size(max = 200)
	private String oldPassword;
	@NotEmpty(message = "对不起，新密码不为空！")
	@Size(max = 200)
	private String newPassword;
	
	private String errorMessage;
	public String getErrorMessage() {
		return errorMessage;
	}
	public void setErrorMessage(String errorMessage) {
		this.errorMessage = errorMessage;
	}
}
