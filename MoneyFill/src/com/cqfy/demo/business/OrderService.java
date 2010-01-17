package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.model.OrderInfo;
import com.cqfy.demo.web.form.OrderForm;

/**
 * 订单业务接口
 * @author LangYu
 *
 */
public interface OrderService {
	/**
	 * 创建一个订单，返回订单的LineNumber
	 * @param order
	 * @return
	 */
	String createOrder(OrderForm order);
	/**
	 * 根据用户ID返回该用户的所有订单
	 * @param userId
	 * @return
	 */
	List<OrderForm> getByUserID(long userId);
	/**
	 * 根据卡号获取所有订单的冲值记录
	 * @param cardNumber
	 * @return
	 */
	List<OrderForm> getByCardNumber(String cardNumber);
	/**
	 * 修改订单的状态
	 * @return
	 */
	boolean modifyStatus(long orderId,int status);
}
