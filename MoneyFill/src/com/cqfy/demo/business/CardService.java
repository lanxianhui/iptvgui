package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.form.CardForm;


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
	boolean createCard(CardForm cardForm);
	/**
	 * 读取绑定记录
	 * @param userId
	 * @param page
	 * @return
	 */
	List<CardForm> getByUserID(long userId,PagingInfo page);
	/**
	 * 获取所有卡号
	 * @param userId
	 * @return
	 */
	List<CardForm> getAllCard(long userId);
	/**
	 * 按照卡号获取所有绑定记录
	 * @param cardNumber
	 * @return
	 */
	List<CardForm> getByCardNumber(String cardNumber,PagingInfo page);
}
