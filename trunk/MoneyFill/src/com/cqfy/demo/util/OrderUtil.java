package com.cqfy.demo.util;

import java.util.List;

import com.cqfy.demo.dao.OrderDao;
import com.cqfy.demo.model.constant.EnumValue.OrderStatus;
import com.cqfy.demo.model.constant.EnumValue.UserSort;

public class OrderUtil {

	@SuppressWarnings("unchecked")
	public static String createLineNumber(long userId,OrderDao orderDao) {
		List<String> l = orderDao
				.query(
						"select max(lineNumber) from OrderInfo order where order.user.id=?",
						new Object[] { userId }, 0, 0);
		String lineNumber = "";
		if (l.size() > 0) {
			lineNumber = l.get(0);
			int serial = Integer.parseInt(lineNumber.substring(12, 17));
			serial++;
			lineNumber = lineNumber.substring(0, 12)
					+ String.format("%05d", serial);
		} else {
			lineNumber = String.format("%1$03d-%2$tY%2$tm%2$td%3$05d",
					new Object[] { userId, new java.util.Date(), 1 });
		}
		return lineNumber;
	}

	public static int getOrderStatusValue(OrderStatus status) {
		switch (status) {
		case NEW_ORDER:
			return 0;
		case PRCESS_ORDER:
			return 1;
		case ACCEPT_ORDER:
			return 2;
		case MOVE_SEND:
			return 3;
		case FINISH:
			return 4;
		default:
			return -1;
		}
	}

	public static String getOrderStatus(OrderStatus status) {
		switch (status) {
		case NEW_ORDER:
			return "新订单";
		case PRCESS_ORDER:
			return "正在处理";
		case ACCEPT_ORDER:
			return "已经接受";
		case MOVE_SEND:
			return "等待移动响应";
		case FINISH:
			return "处理完成";
		default:
			return "系统故障";
		}
	}

	public static String getUserSort(UserSort sort) {
		switch (sort) {
		case SORT_USER:
			return "普通用户";
		case SORT_ADMIN:
			return "管理员";
		default:
			return "未知用户";
		}
	}
}
