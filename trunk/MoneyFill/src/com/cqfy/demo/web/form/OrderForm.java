package com.cqfy.demo.web.form;

import java.io.Serializable;
import java.math.BigDecimal;

import org.springframework.stereotype.Component;

import com.cqfy.demo.util.BeanNames;

@Component(BeanNames.BEAN_FORM_ORDER)
public class OrderForm implements Serializable{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 7348416894495191580L;
	private long id;
	private String lineNumber;
	private String cardNumber;
	private BigDecimal price;
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
}
