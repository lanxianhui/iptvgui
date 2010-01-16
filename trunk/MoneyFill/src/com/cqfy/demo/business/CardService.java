package com.cqfy.demo.business;


/**
 * 用户业务接口，卡的业务接口
 * @author LangYu
 *
 */
public interface CardService {
	/**
	 * 
	 * @param cardInfo
	 * @return 返回绑定的相关信息
	 */
	boolean createCard(String cardNumber,String mobileNumber);
	
}
