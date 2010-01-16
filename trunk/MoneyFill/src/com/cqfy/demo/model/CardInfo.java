package com.cqfy.demo.model;

import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;
/**
 * 
 * @author LangYu
 *
 */
@Entity
@Table(name="fm_card")
@Component(BeanNames.BEAN_MODEL_CARD)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
public class CardInfo {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	@Column(name="id")
	private long id;
	
	@Column(name="cardnumber")
	private String cardNumber;
	
	@Column(name="mobilenumber")
	private String mobileNumber;
	
	@ManyToOne
	@JoinColumn(name="userid")
	private UserInfo user;
	
	@Temporal(TemporalType.TIMESTAMP)
	@Column(name="createtime")
	private Date createTime;
	
	public long getId() {
		return id;
	}
	public void setId(long id) {
		this.id = id;
	}
	public String getCardnumber() {
		return cardNumber;
	}
	public void setCardnumber(String cardNumber) {
		this.cardNumber = cardNumber;
	}
	public String getMobilenumber() {
		return mobileNumber;
	}
	public void setMobilenumber(String mobilenumber) {
		this.mobileNumber = mobilenumber;
	}
	public UserInfo getUser() {
		return user;
	}
	public void setUser(UserInfo user) {
		this.user = user;
	}
	public Date getCreatetime() {
		return createTime;
	}
	public void setCreatetime(Date createTime) {
		this.createTime = createTime;
	}
}
