package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.model.OrderInfo;

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
	String createOrder(OrderInfo order);
	/**
	 * �����û�ID���ظ��û������ж���
	 * @param userId
	 * @return
	 */
	List<OrderInfo> getByUserID(long userId);
	/**
	 * ���ݿ��Ż�ȡ���ж����ĳ�ֵ��¼
	 * @param cardNumber
	 * @return
	 */
	List<OrderInfo> getByCardNumber(String cardNumber);
	/**
	 * �޸Ķ�����״̬
	 * @return
	 */
	boolean modifyStatus(OrderInfo order,int status);
}
