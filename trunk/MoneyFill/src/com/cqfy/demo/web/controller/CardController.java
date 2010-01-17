package com.cqfy.demo.web.controller;

import java.util.List;

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

import com.cqfy.demo.business.CardService;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.util.PagingInfo;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.CardForm;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class CardController extends BaseController {

	private CardService cardService;

	@Autowired
	public void setCardService(
			@Qualifier(BeanNames.BEAN_SERVICE_CARD) CardService cardService) {
		this.cardService = cardService;
	}

	/**
	 * 重定向的Controller
	 */
	@RequestMapping(value = PageValue.ACTION_USER_BINDFORM)
	public String initBind(HttpServletRequest request, ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			CardForm cardForm = (CardForm) getBean(BeanNames.BEAN_FORM_CARD);
			model.addAttribute(PageValue.INIT_USERBIND, cardForm);
			return PageValue.PAGE_USER_CARDFORM;
		} else {
			return resultPage;
		}
	}
	
	@RequestMapping(value = PageValue.ACTION_USER_LISTPRICE)
	public String listPrice(HttpServletRequest request, @RequestParam("pageindex") int pageindex,ModelMap model)
			throws Exception {
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			HttpSession session = request.getSession();
			UserForm user = (UserForm) session
					.getAttribute(PageValue.SESSION_USER);
			PagingInfo page = new PagingInfo(pageindex, 10);
			List<CardForm> cards = this.cardService.getByUserID(user.getId(), page);
			model.addAttribute(PageValue.LIST_CARD,cards);
			return PageValue.PAGE_USER_LISTPRICE;
		} else {
			return resultPage;
		}
	}

	@RequestMapping(value = PageValue.ACTION_USER_ADDCARD, method = RequestMethod.POST)
	public String addCard(HttpServletRequest request,
			@Valid @ModelAttribute(PageValue.INIT_USERBIND) CardForm cardForm,
			BindingResult result, ModelMap model) {
		String resultPage = checkLogin(request,model);
		if (resultPage == null) {
			if (result.hasErrors()) {
				return PageValue.PAGE_USER_CARDFORM;
			} else {
				// 从会话中获取UserInfo
				HttpSession session = request.getSession();
				UserForm userForm = (UserForm) session
						.getAttribute(PageValue.SESSION_USER);
				cardForm.setUserForm(userForm);
				boolean resultCode = cardService.createCard(cardForm);

				if (resultCode) {
					model.addAttribute(PageValue.SUCCESS_BIND, cardForm);
					return PageValue.PAGE_USER_BINDSUCCESS;
				} else {
					return PageValue.PAGE_USER_CARDFORM;
				}
			}
		} else {
			return resultPage;
		}
	}

}
