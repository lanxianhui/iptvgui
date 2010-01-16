package com.cqfy.demo.web.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.web.bind.annotation.RequestMapping;

import com.cqfy.demo.business.CardService;
import com.cqfy.demo.util.BeanNames;
import com.cqfy.demo.web.BaseController;

@Controller
public class CardController extends BaseController{
	
	private CardService cardService;
	
	@Autowired
	public void setCardService(@Qualifier(BeanNames.BEAN_SERVICE_CARD) CardService cardService){
		this.cardService = cardService;
	}
	
	@RequestMapping(params= "method=addcard")
	public String addCard(ModelMap model){
		System.out.println("Card Created");
		return "testAction.jsp";
	}
	
	
}
