package com.cqfy.demo.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.UserSort;
import com.cqfy.demo.util.BeanNames;

/**
 * 
 * @author LangYu
 *
 */
@Entity
@Table(name="fm_user")
@Component(BeanNames.BEAN_MODEL_USER)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
public class UserInfo {
	
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	@Column(name="id")
	private long id;
	
	@Column(name="username")
	private String userName;
	
	@Column(name="password")
	private String password;
	
	@Column(name="usersort")
	@Enumerated(EnumType.ORDINAL)
	private UserSort userSort;
	
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public UserSort getUserSort() {
		return userSort;
	}
	public void setUserSort(UserSort userSort) {
		this.userSort = userSort;
	}
}
