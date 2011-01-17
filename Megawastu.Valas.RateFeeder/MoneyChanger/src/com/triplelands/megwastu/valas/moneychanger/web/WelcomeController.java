package com.triplelands.megwastu.valas.moneychanger.web;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
@RequestMapping("/welcome")
public class WelcomeController {

	private Log logger = LogFactory.getLog(WelcomeController.class);

	@RequestMapping(method = RequestMethod.GET)
	public void welcome() {
		logger.info("Welcome!");
	}
}
