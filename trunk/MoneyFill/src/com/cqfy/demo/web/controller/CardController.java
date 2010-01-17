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

import com.cqfy.demo.business.CardService;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.util.PageValue;
import com.cqfy.demo.web.BaseController;
import com.cqfy.demo.web.form.CardForm;
import com.cqfy.demo.web.form.UserForm;

@Controller
public class CardController extends BaseController{
	
	private CardService cardService;
	
	@Autowired
	public void setCardService(@Qualifier(BeanNames.BEAN_SERVICE_CARD) CardService cardService){
		this.cardService = cardService;
	}
	/**
	 * �ض����Controller
	 */
	@RequestMapping(value=PageValue.ACTION_USER_BINDFORM)
	public String initBind(HttpServletRequest request,ModelMap model) throws Exception{
		CardForm cardForm = (CardForm)getBean(BeanNames.BEAN_FORM_CARD);
		HttpSession session = request.getSession();
		UserForm userForm = (UserForm)session.getAttribute(BeanNames.BEAN_FORM_USER);
		cardForm.setUserForm(userForm);
		model.addAttribute(PageValue.INIT_USERBIND,cardForm);
		return PageValue.PAGE_USER_CARDFORM;
	}
	
	@RequestMapping(value = PageValue.ACTION_USER_ADDCARD,method=RequestMethod.POST)
	public String addCard(@Valid @ModelAttribute(PageValue.INIT_USERBIND) CardForm cardForm,BindingResult result){
		if(result.hasErrors()){
			return PageValue.PAGE_USER_CARDFORM;
		}else{
			boolean resultCode = cardService.createCard(cardForm);
			if(resultCode){
				return PageValue.PAGE_USER_BINDSUCCESS;
			}else{
				return PageValue.PAGE_USER_CARDFORM;
			}
		}
	}
	
	
}
