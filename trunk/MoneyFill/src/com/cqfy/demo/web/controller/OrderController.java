package com.cqfy.demo.web.controller;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.cqfy.demo.business.OrderService;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.OrderForm;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class OrderController extends BaseController{
	
	private OrderService orderService;
	
	@Autowired
	public void setOrderService(@Qualifier(BeanNames.BEAN_SERVICE_ORDER) OrderService orderService){
		this.orderService = orderService;
	}
	
	@RequestMapping(value=PageValue.ACTION_USER_LISTORDERS)
	public String listOrders(ModelMap model) throws Exception{
		return PageValue.PAGE_USER_LISTORDERS;
	}
	
	@RequestMapping(value=PageValue.ACTION_USER_LISTPRICE)
	public String listPrice(ModelMap model) throws Exception{
		return PageValue.PAGE_USER_LISTPRICE;
	}
	
	@RequestMapping(value=PageValue.ACTION_USER_CARDFORM)
	public String initFillCard(HttpServletRequest request,ModelMap model) throws Exception{
		OrderForm orderForm = (OrderForm)getBean(BeanNames.BEAN_FORM_ORDER);
		HttpSession session = request.getSession();
		UserForm userForm = (UserForm)session.getAttribute(BeanNames.BEAN_FORM_USER);
		orderForm.setUserForm(userForm);
		model.addAttribute(PageValue.INIT_USERORDER,orderForm);
		return PageValue.PAGE_USER_ORDERFORM;
	}
	
	@RequestMapping(value=PageValue.ACTION_USER_ADDORDER,method=RequestMethod.POST)
	public String addOrders(@Valid @ModelAttribute(PageValue.INIT_USERORDER) OrderForm orderForm,ModelMap map,BindingResult result) throws Exception{
		if( result.hasErrors()){
			return PageValue.PAGE_USER_ORDERFORM;
		}else{
			boolean resultCode = orderService.createOrder(orderForm);
			if( resultCode ){
				return PageValue.PAGE_USER_ORDERSUCCESS;
			}else{
				return PageValue.PAGE_USER_ORDERFORM;
			}
		}
	}
}
