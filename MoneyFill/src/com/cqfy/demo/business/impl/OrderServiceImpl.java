package com.cqfy.demo.business.impl;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;
import java.util.TreeMap;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Service;

import com.cqfy.demo.business.OrderService;
import com.cqfy.demo.dao.CardDao;
import com.cqfy.demo.dao.OrderDao;
import com.cqfy.demo.dao.UserDao;
import com.cqfy.demo.model.CardInfo;
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
	private CardDao cardDao;
	
	private OrderInfo orderInfo;
	
	@Autowired
	public void setCardDao(@Qualifier(BeanNames.BEAN_DAO_CARD) CardDao cardDao){
		this.cardDao = cardDao;
	}
	
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
		boolean check = checkCard(order.getCardNumber(),order.getUserForm().getId());
		if( !check ){
			System.out.println("Error!");
			order.setErrorMessage("对不起，您输入的卡号没有绑定，请重新输入！");
			return false;
		}
		orderInfo.setCardNumber(order.getCardNumber());
		orderInfo.setLineNumber(OrderUtil.createLineNumber(order.getUserForm().getId(),this.orderDao));
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
	
	@SuppressWarnings("unchecked")
	private boolean checkCard(String cardNumber,long userid){
		String NSQL = "select * from fm_card where cardNumber=? and userid=?";
		Object[] params = { cardNumber,Long.valueOf(userid)};
		List<CardInfo> cards = this.cardDao.queryNativeSQL(NSQL, params, 0, 0);
		if( cards.size() == 0 )
			return false;
		else
			return true;
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
		orderForm.setUsername(order.getUser().getUserName());
	}

	@Override
	public boolean modifyStatus(long orderId, OrderStatus status) {
		try{
			this.orderInfo = this.orderDao.read(orderId);
			this.orderInfo.setStatus(status);
			this.orderInfo.setModifyTime(new Date());
			this.orderDao.update(this.orderInfo);
			return true;
		}catch(Exception ex){
			return false;
		}
	}

	@Override
	@SuppressWarnings("unchecked")
	public List<OrderForm> getAllOrders(PagingInfo page) {
		String NSQL = "select * from fm_order order by ordertime desc";
		Object[] params = {};
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

	@Override
	public OrderForm getOrderById(long orderId) {
		OrderInfo order = this.orderDao.read(orderId);
		OrderForm form = new OrderForm();
		fillOrderForm(order, form);
		return form;
	}

	@Override
	@SuppressWarnings("unchecked")
	public Map<String, BigDecimal> getTotalOrders(Date fromDate,
			Date toDate, long userId,String cardNumber) {
		Map<String, BigDecimal> orderMap = new TreeMap<String,BigDecimal>();
		for( OrderStatus status : OrderStatus.values()){
			String queryString = "";
			List<BigDecimal> sumValue = new ArrayList<BigDecimal>();
			if(cardNumber == null || cardNumber.trim().equals("")){
				queryString = "select sum(price) from OrderInfo order where order.user.id=? and order.orderTime < ? and order.orderTime > ? and order.status=?";
				Object[] params = { Long.valueOf(userId),toDate,fromDate,status};
				sumValue = this.orderDao.query(queryString, params, 0, 0);
			}else{
				queryString = "select sum(price) from OrderInfo order where order.cardNumber = ? and order.user.id=? and order.orderTime < ? and order.orderTime > ? and order.status=?";
				Object[] params = {cardNumber,Long.valueOf(userId),toDate,fromDate,status};
				sumValue = this.orderDao.query(queryString, params, 0, 0);
			}
			if( sumValue.size() != 0){
				orderMap.put(OrderUtil.getOrderStatus(status), sumValue.get(0));
			}else{
				orderMap.put(OrderUtil.getOrderStatus(status), new BigDecimal("0.00"));
			}
		}
		return orderMap;
	}

	@Override
	@SuppressWarnings("unchecked")
	public List<OrderForm> loadOrders() {
		String NSQL = "select * from fm_order order by ordertime desc";
		List<OrderInfo> orders = this.orderDao.queryNativeSQL(NSQL);
		List<OrderForm> forms = new ArrayList<OrderForm>();
		for( OrderInfo order : orders){
			OrderForm form = new OrderForm();
			fillOrderForm(order, form);
			forms.add(form);
		}
		return forms;
	}

	@Override
	public List<OrderForm> getOrders(Date from, Date to, long userId,String cardNumber,PagingInfo page) {
		List<OrderInfo> orders = new ArrayList<OrderInfo>();
		if(cardNumber == null || cardNumber.equals("")){
			String queryString = "user.id=? and orderTime < ? and orderTime > ? order by orderTime desc";
			Object[] params = { Long.valueOf(userId),to,from};
			orders = this.orderDao.find(queryString, params, 
					(page.getPageIndex() - 1) * page.getPageSize(), page.getPageSize());
		}else{
			String queryString = "user.id=? and orderTime < ? and orderTime > ? and cardNumber=? order by orderTime desc";
			Object[] params = { Long.valueOf(userId),to,from,cardNumber};
			orders = this.orderDao.find(queryString, params, 
					(page.getPageIndex() - 1) * page.getPageSize(), page.getPageSize());
		}
		List<OrderForm> forms = new ArrayList<OrderForm>();
		for( OrderInfo order : orders){
			OrderForm form = new OrderForm();
			fillOrderForm(order, form);
			forms.add(form);
		}
		return forms;
	}

}
