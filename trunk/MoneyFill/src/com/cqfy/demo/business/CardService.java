package com.cqfy.demo.business;


/**
 * �û�ҵ��ӿڣ�����ҵ��ӿ�
 * @author LangYu
 *
 */
public interface CardService {
	/**
	 * 
	 * @param cardInfo
	 * @return ���ذ󶨵������Ϣ
	 */
	boolean createCard(String cardNumber,String mobileNumber);
	
}
