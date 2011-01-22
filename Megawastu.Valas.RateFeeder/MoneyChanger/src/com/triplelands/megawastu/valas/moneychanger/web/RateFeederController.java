package com.triplelands.megawastu.valas.moneychanger.web;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.SchedulerException;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
@RequestMapping("/ratefeeder")
public class RateFeederController {

	protected Log log = LogFactory.getLog(RateFeederController.class);

	

	@RequestMapping(method = RequestMethod.GET)
	public String status(ModelMap model) {
		
		
		
		return "ratefeeder";
	}
	
	@RequestMapping(value="/{status}",  method = RequestMethod.GET)
	public String process(@PathVariable String status) throws SchedulerException {
		log.info("status: " + status);
		
		return "redirect:ratefeeder";
	}
}
