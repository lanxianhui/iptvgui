package com.cqfy.demo.business;

import java.util.List;

import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.form.CardForm;


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
	boolean createCard(CardForm cardForm);
	/**
	 * ��ȡ�󶨼�¼
	 * @param userId
	 * @param page
	 * @return
	 */
	List<CardForm> getByUserID(long userId,PagingInfo page);
}
