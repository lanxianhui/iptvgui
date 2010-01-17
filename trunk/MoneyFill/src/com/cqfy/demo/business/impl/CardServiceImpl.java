package com.cqfy.demo.business.impl;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.CardService;
import com.cqfy.demo.dao.CardDao;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.CardInfo;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.web.form.CardForm;

@Service(BeanNames.BEAN_SERVICE_CARD)
@Scope("singleton")
public class CardServiceImpl implements CardService{
	
	private CardDao cardDao;
	private UserDao userDao;
	
	private CardInfo card;
	
	@Autowired
	public CardServiceImpl(@Qualifier(BeanNames.BEAN_DAO_CARD) CardDao cardDao){
		this.cardDao = cardDao;
	}
	
	@Autowired
	public void setUserDao(@Qualifier(BeanNames.BEAN_DAO_USER) UserDao userDao){
		this.userDao = userDao;
	}
	
	@Autowired
	public void setCardInfo(@Qualifier(BeanNames.BEAN_MODEL_CARD) CardInfo cardInfo){
		this.card = cardInfo;
	}

	@Override
	public boolean createCard(CardForm cardForm) {
		//CardInfo card = (CardInfo)BeanFactory.getBean(BeanNames.BEAN_MODEL_CARD);
		card.setCardnumber(cardForm.getCardNumber());
		card.setCreatetime(new Date());
		card.setMobilenumber(cardForm.getMobileNumber());
		card.setUser(userDao.read(cardForm.getUserForm().getId()));
		try{
			this.cardDao.save(card);
			cardForm.setId(card.getId());
			return true;
		}catch(Exception ex){
			return false;
		}
	}


}
