package com.cqfy.demo.dao.impl;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Repository;

import com.cqfy.demo.dao.CardDao;
import com.cqfy.demo.dao.generic.GenericDAOImpl;
import com.cqfy.demo.model.CardInfo;
import com.cqfy.demo.util.BeanNames;

@Repository(BeanNames.BEAN_DAO_CARD)
@Scope("prototype")
public class CardDaoImpl extends GenericDAOImpl<CardInfo> implements CardDao{
	public CardDaoImpl(){
		super(CardInfo.class);
	}
}
