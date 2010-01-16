package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.model.OrderInfo;

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
	String createOrder(OrderInfo order);
	/**
	 * 根据用户ID返回该用户的所有订单
	 * @param userId
	 * @return
	 */
	List<OrderInfo> getByUserID(long userId);
	/**
	 * 根据卡号获取所有订单的冲值记录
	 * @param cardNumber
	 * @return
	 */
	List<OrderInfo> getByCardNumber(String cardNumber);
	/**
	 * 修改订单的状态
	 * @return
	 */
	boolean modifyStatus(OrderInfo order,int status);
}
