package com.cqfy.demo.business.impl;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.OrderService;
import com.cqfy.demo.dao.OrderDao;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.OrderInfo;
import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.OrderUtil;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.form.OrderForm;

@Service(BeanNames.BEAN_SERVICE_ORDER)
@Scope("singleton")
public class OrderServiceImpl implements OrderService{
	
	private OrderDao orderDao;
	private UserDao userDao;
	
	private OrderInfo orderInfo;
	
	@Autowired
	public void setOrderDao(@Qualifier(BeanNames.BEAN_DAO_ORDER) OrderDao orderDao){
		this.orderDao = orderDao;
	}
	
	@Autowired
	public void setUserDao(@Qualifier(BeanNames.BEAN_DAO_USER) UserDao userDao){
		this.userDao = userDao;
	}
	
	@Autowired
	public void setOrderInfo(@Qualifier(BeanNames.BEAN_MODEL_ORDER) OrderInfo orderInfo){
		this.orderInfo = orderInfo;
	}

	@Override
	public boolean createOrder(OrderForm order) {
		orderInfo.setCardNumber(order.getCardNumber());
		orderInfo.setLineNumber(OrderUtil.createLineNumber());
		orderInfo.setOrderTime(new Date());
		orderInfo.setModifyTime(new Date());
		orderInfo.setUser(userDao.read(order.getUserForm().getId()));
		orderInfo.setStatus(OrderStatus.NEW_ORDER);
		orderInfo.setPrice(new BigDecimal(order.getPrice()));
		try{
			this.orderDao.save(orderInfo);
			order.setLineNumber(orderInfo.getLineNumber());
			order.setId(orderInfo.getId());
			return true;
		}catch(Exception ex){
			ex.printStackTrace();
			return false;
		}
	}

	@Override
	public List<OrderForm> getByCardNumber(String cardNumber) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	@SuppressWarnings("unchecked")
	public List<OrderForm> getByUserID(long userId,PagingInfo page) {
		String NSQL = "select * from fm_order where userid=? order by ordertime desc";
		Object[] params = { Long.valueOf(userId)};
		List<OrderInfo> orders = this.orderDao.queryNativeSQL(NSQL, params, 
				(page.getPageIndex() - 1) * page.getPageSize(), page.getPageSize());
		List<OrderForm> forms = new ArrayList<OrderForm>();
		for( OrderInfo order : orders){
			OrderForm form = new OrderForm();
			fillOrderForm(order, form);
			forms.add(form);
		}
		return forms;
	}
	
	private void fillOrderForm(OrderInfo order,OrderForm orderForm){
		orderForm.setId(order.getId());
		orderForm.setCardNumber(order.getCardNumber());
		orderForm.setLineNumber(order.getLineNumber());
		orderForm.setPrice(order.getPrice().toString());
		orderForm.setStatus(order.getStatus());
		orderForm.setCreateTime(order.getOrderTime());
	}

	@Override
	public boolean modifyStatus(long orderId, int status) {
		// TODO Auto-generated method stub
		return false;
	}

}