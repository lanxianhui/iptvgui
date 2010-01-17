package com.cqfy.demo.web.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.web.bind.annotation.RequestMapping;

import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.OrderForm;

@Controller
public class OrderController extends BaseController{
	
	@RequestMapping(value=BeanNames.ACTION_USER_LISTORDERS)
	public String listOrders(ModelMap model) throws Exception{
		return BeanNames.PAGE_USER_LISTORDERS;
	}
	
	@RequestMapping(value=BeanNames.ACTION_USER_LISTPRICE)
	public String listPrice(ModelMap model) throws Exception{
		return BeanNames.PAGE_USER_LISTPRICE;
	}
	
	@RequestMapping(value=BeanNames.ACTION_USER_FILLCARD)
	public String initFillCard(ModelMap model) throws Exception{
		OrderForm orderForm = (OrderForm)getBean(BeanNames.BEAN_FORM_ORDER);
		model.addAttribute(BeanNames.INIT_USERCARD,orderForm);
		return BeanNames.PAGE_USER_FILLCARD;
	}
}
