package com.cqfy.demo.model;

import java.util.Date;

import javax.persistence.Column;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

import javax.persistence.Entity;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;
/**
 * 
 * @author LangYu
 *
 */
@Entity
@Table(name="fm_order")
@Component(BeanNames.BEAN_MODEL_ORDER)
@Scope("prototype")
public class OrderInfo {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	@Column(name = "id")
	private long id;
	
	@Column(name = "linenumber")
	private String lineNumber;
	
	@Column(name = "cardnumber")
	private String cardNumber;
	
	@Column(name = "price")
	private double price;
	
	@Column(name = "status")
	private int status;
	
	@ManyToOne
	@JoinColumn(name="userid")
	private UserInfo user;
	
	@Temporal(TemporalType.TIMESTAMP)
	@Column(name="ordertime")
	private Date orderTime;
	
	@Temporal(TemporalType.TIMESTAMP)
	@Column(name="modifytime")
	private Date modifyTime;
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
	public double getPrice() {
		return price;
	}
	public void setPrice(double price) {
		this.price = price;
	}
	public int getStatus() {
		return status;
	}
	public void setStatus(int status) {
		this.status = status;
	}
	public UserInfo getUser() {
		return user;
	}
	public void setUser(UserInfo user) {
		this.user = user;
	}
	public Date getOrderTime() {
		return orderTime;
	}
	public void setOrderTime(Date orderTime) {
		this.orderTime = orderTime;
	}
	public Date getModifyTime() {
		return modifyTime;
	}
	public void setModifyTime(Date modifyTime) {
		this.modifyTime = modifyTime;
	}
}
