package com.cqfy.demo.business;

import java.util.List;

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
	String createOrder(OrderForm order);
	/**
	 * �����û�ID���ظ��û������ж���
	 * @param userId
	 * @return
	 */
	List<OrderForm> getByUserID(long userId);
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
	boolean modifyStatus(long orderId,int status);
}