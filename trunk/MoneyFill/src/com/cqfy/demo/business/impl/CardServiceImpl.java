package com.cqfy.demo.business.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.CardService;
import com.cqfy.demo.dao.CardDao;
import com.cqfy.demo.util.BeanNames;

@Service(BeanNames.BEAN_SERVICE_CARD)
@Scope("singleton")
public class CardServiceImpl implements CardService{
	
	private CardDao cardDao;
	
	@Autowired
	public CardServiceImpl(@Qualifier(BeanNames.BEAN_DAO_CARD) CardDao cardDao){
		this.cardDao = cardDao;
	}

	@Override
	public boolean createCard(String cardNumber, String mobileNumber) {
		// TODO Auto-generated method stub
		return false;
	}

}
