package com.cqfy.demo.business;

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
	
}
