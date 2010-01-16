package com.cqfy.demo.dao.impl;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Repository;

import com.cqfy.demo.dao.OrderDao;
import com.cqfy.demo.dao.generic.GenericDAOImpl;
import com.cqfy.demo.model.OrderInfo;
import com.cqfy.demo.util.BeanNames;

@Repository(BeanNames.BEAN_DAO_ORDER)
@Scope("prototype")
public class OrderDaoImpl extends GenericDAOImpl<OrderInfo> implements OrderDao{
	public OrderDaoImpl(){
		super(OrderInfo.class);
	}
}
