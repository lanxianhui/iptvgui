package com.cqfy.demo.model;

import java.math.BigDecimal;
import java.util.Date;

import javax.persistence.Column;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

import javax.persistence.Entity;

import org.springframework.beans.factory.config.BeanDefinition;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.BeanNames;
/**
 * 
 * @author LangYu
 *
 */
@Entity
@Table(name="fm_order")
@Component(BeanNames.BEAN_MODEL_ORDER)
@Scope(BeanDefinition.SCOPE_PROTOTYPE)
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
	private BigDecimal price;
	
	@Column(name = "status")
	@Enumerated(EnumType.ORDINAL)
	private OrderStatus status;
	
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
	public BigDecimal getPrice() {
		return price;
	}
	public void setPrice(BigDecimal price) {
		this.price = price;
	}
	public OrderStatus getStatus() {
		return status;
	}
	public void setStatus(OrderStatus status) {
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
