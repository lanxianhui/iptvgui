package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.form.OrderForm;

/**
 * ����ҵ��ӿ�
 * @author LangYu
 *
 */
public interface OrderService {
	/**
	 * ����һ�����������ض�����LineNumber
	 * @param order
	 * @return
	 */
	boolean createOrder(OrderForm order);
	/**
	 * �����û�ID���ظ��û������ж���
	 * @param userId
	 * @return
	 */
	List<OrderForm> getByUserID(long userId,PagingInfo page);
	/**
	 * ���ݿ��Ż�ȡ���ж����ĳ�ֵ��¼
	 * @param cardNumber
	 * @return
	 */
	List<OrderForm> getByCardNumber(String cardNumber);
	/**
	 * �޸Ķ�����״̬
	 * @return
	 */
	boolean modifyStatus(long orderId,OrderStatus status);
	/**
	 * ��ȡ���еĶ�����Ϣ
	 * @param page
	 * @return
	 */
	List<OrderForm> getAllOrders(PagingInfo page);
	/**
	 * ���ݶ���id��ȡ��������
	 * @param orderId
	 * @return
	 */
	OrderForm getOrderById(long orderId);
}
