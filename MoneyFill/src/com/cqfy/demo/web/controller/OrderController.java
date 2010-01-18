package com.cqfy.demo.web.controller;

import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Map;

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
import org.springframework.web.bind.annotation.RequestParam;

import com.cqfy.demo.business.OrderService;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.OrderForm;
import com.cqfy.demo.web.form.StatusForm;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class OrderController extends BaseController {

	private OrderService orderService;

	@Autowired
	public void setOrderService(
			@Qualifier(BeanNames.BEAN_SERVICE_ORDER) OrderService orderService) {
		this.orderService = orderService;
	}
	
	@RequestMapping(value = PageValue.ACTION_USER_ORDERTOTAL,method = RequestMethod.POST)
	public String countTotalOrders(HttpServletRequest request,
			@RequestParam("x_fromDate") String fromDate,@RequestParam("x_toDate") String toDate,
			ModelMap model) throws ParseException{
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			HttpSession session = request.getSession();
			UserForm user = (UserForm) session
					.getAttribute(PageValue.SESSION_USER);
			
			SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
			Date from = format.parse(fromDate);
			Date to = format.parse(toDate);
			Map<String, BigDecimal> resultTotal = this.orderService.getTotalOrders(from, to, user.getId());
			model.addAttribute(PageValue.VIEW_TOTAL_MAP,resultTotal);
			return PageValue.PAGE_USER_ORDERTOTAL;
		}else{
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_LISTORDERS, method = RequestMethod.GET)
	public String listOrders(HttpServletRequest request,
			@RequestParam("pageindex") int pageindex, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			HttpSession session = request.getSession();
			UserForm user = (UserForm) session
					.getAttribute(PageValue.SESSION_USER);
			PagingInfo page = new PagingInfo(pageindex, 10);
			List<OrderForm> orders = orderService.getByUserID(user.getId(),
					page);
			model.addAttribute(PageValue.LIST_ORDERS, orders);
			return PageValue.PAGE_USER_LISTORDERS;
		} else {
			return resultPage;
		}
	}
	
	@RequestMapping(value = PageValue.ACTION_ADMIN_LISTORDERS)
	public String listAllOrders(HttpServletRequest request,@RequestParam("pageindex") int pageindex,ModelMap model){
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			PagingInfo page = new PagingInfo(pageindex, 10);
			List<OrderForm> orders = orderService.getAllOrders(page);
			model.addAttribute(PageValue.LIST_ORDERS, orders);
			return PageValue.PAGE_ADMIN_LISTORDERS;
		}else{
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_CARDFORM)
	public String initFillCard(HttpServletRequest request, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			OrderForm orderForm = (OrderForm) getBean(BeanNames.BEAN_FORM_ORDER);
			model.addAttribute(PageValue.INIT_USERORDER, orderForm);
			return PageValue.PAGE_USER_ORDERFORM;
		} else {
			return resultPage;
		}
	}
	
	@RequestMapping(value = PageValue.ACTION_ADMIN_VIEWORDER)
	public String viewOrder(HttpServletRequest request,@RequestParam("id") long id,ModelMap model)
	{
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			OrderForm form = this.orderService.getOrderById(id);
			model.addAttribute(PageValue.VIEW_ORDER,form);
			StatusForm statusForm = (StatusForm)getBean(BeanNames.BEAN_FORM_STATUS);
			model.addAttribute(PageValue.INIT_STATUS, statusForm);
			return PageValue.PAGE_ADMIN_VIEWORDER;
		}else{
			return resultPage;
		}
	}
	
	@RequestMapping(value = PageValue.ACTION_ADMIN_ORDERUPDATE)
	public String modifyStatus(HttpServletRequest request,@ModelAttribute(PageValue.INIT_STATUS) StatusForm status,ModelMap model)
	{
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			System.out.println(status.getId());
			System.out.println(status.getStatus());
			boolean result = this.orderService.modifyStatus(status.getId(), status.getStatus());
			if( result ){
				return PageValue.ACTION_ADMIN_LISTORDERS + "?pageindex=0";
			}else{
				return PageValue.ACTION_ADMIN_VIEWORDER + "?id=" + status.getId();
			}
		}else{
			return resultPage;
		}
	}
	
	@RequestMapping(value = "/loadorders.service",method=RequestMethod.POST)
	public String loadOrders(HttpServletRequest request,ModelMap model){
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			List<OrderForm> orders = this.orderService.loadOrders();
			model.addAttribute("ajaxOrders",orders);
			return "admin/orderlist.jsp";
		}else{
			return resultPage;
		}
	}
	
	@RequestMapping(value = PageValue.ACTION_USER_ADDORDER, method = RequestMethod.POST)
	public String addOrders(
			HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_USERORDER) OrderForm orderForm,
			BindingResult result, ModelMap map) throws Exception {
		String resultPage = checkLogin(request,map);
		if (resultPage == null) {
			if (result.hasErrors()) {
				return PageValue.PAGE_USER_ORDERFORM;
			} else {
				// 设置会话数据
				HttpSession session = request.getSession();
				UserForm userForm = (UserForm) session
						.getAttribute(PageValue.SESSION_USER);
				orderForm.setUserForm(userForm);

				boolean resultCode = orderService.createOrder(orderForm);
				if (resultCode) {
					map.addAttribute(PageValue.SUCCESS_ORDER, orderForm);
					return PageValue.PAGE_USER_ORDERSUCCESS;
				} else {
					map.addAttribute(PageValue.MSG_ORDERERROR, orderForm.getErrorMessage());
					return PageValue.PAGE_USER_ORDERFORM;
				}
			}
		}else{
			return resultPage;
		}
	}
}
