package com.cqfy.demo.util;

import com.cqfy.demo.model.constant.EnumValue.OrderStatus;

public class OrderUtil {
	
	public static String createLineNumber(){
		return "123456";
	}
	
	public static String getOrderStatus(OrderStatus status){
		switch (status) {
		case NEW_ORDER:
			return "�¶���";
		case PRCESS_ORDER:
			return "���ڴ���";
		case ACCEPT_ORDER:
			return "�ѽ���";
		case MOVE_SEND:
			return "�ȴ��ƶ���Ӧ";
		case FINISH:
			return "�����";
		default:
			return "ϵͳ����";
		}
	}
}
