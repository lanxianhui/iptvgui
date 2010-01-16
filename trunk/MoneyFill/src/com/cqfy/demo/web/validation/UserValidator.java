package com.cqfy.demo.web.validation;

import org.springframework.validation.Errors;
import org.springframework.validation.Validator;

import com.cqfy.demo.web.form.UserForm;

public class UserValidator implements Validator{

	@Override
	public boolean supports(Class<?> user) {
		return UserForm.class.isAssignableFrom(user);
	}

	@Override
	public void validate(Object user, Errors errors) {
		// TODO Auto-generated method stub
	}
}
