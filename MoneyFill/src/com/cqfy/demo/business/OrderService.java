package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.PagingInfo;
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
	boolean createOrder(OrderForm order);
	/**
	 * 根据用户ID返回该用户的所有订单
	 * @param userId
	 * @return
	 */
	List<OrderForm> getByUserID(long userId,PagingInfo page);
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
	boolean modifyStatus(long orderId,OrderStatus status);
	/**
	 * 读取所有的订单信息
	 * @param page
	 * @return
	 */
	List<OrderForm> getAllOrders(PagingInfo page);
	/**
	 * 根据订单id获取订单对象
	 * @param orderId
	 * @return
	 */
	OrderForm getOrderById(long orderId);
}
