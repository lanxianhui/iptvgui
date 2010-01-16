package com.cqfy.demo.business.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.OrderService;
import com.cqfy.demo.dao.OrderDao;
import com.cqfy.demo.model.OrderInfo;
import com.cqfy.demo.util.BeanNames;

@Service(BeanNames.BEAN_SERVICE_ORDER)
@Scope("singleton")
public class OrderServiceImpl implements OrderService{
	
	private OrderDao orderDao;
	
	@Autowired
	public void setOrderDao(@Qualifier(BeanNames.BEAN_DAO_ORDER) OrderDao orderDao){
		this.orderDao = orderDao;
	}

	@Override
	public String createOrder(OrderInfo order) {
		// TODO Auto-generated method stub
		this.orderDao.save(order);
		return null;
	}

	@Override
	public List<OrderInfo> getByCardNumber(String cardNumber) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public List<OrderInfo> getByUserID(long userId) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public boolean modifyStatus(OrderInfo order, int status) {
		// TODO Auto-generated method stub
		return false;
	}
}
