package com.triplelands.megawastu.valas.moneychanger.web;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.SchedulerException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.triplelands.megawastu.valas.moneychanger.scheduler.IRateFeeder;

@Controller
@RequestMapping("/ratefeeder")
public class RateFeederController {

	protected Log log = LogFactory.getLog(RateFeederController.class);
	IRateFeeder rateFeeder;

	@Autowired
	public void setRateFeeder(IRateFeeder rateFeeder) {
		this.rateFeeder = rateFeeder;
	}

	@RequestMapping(method = RequestMethod.GET)
	public String status(ModelMap model) {
		
		if (rateFeeder.isStarted()) {
			model.addAttribute("status", "started");
		} else {
			model.addAttribute("status", "stopped");
		}
		
		return "ratefeeder";
	}
	
	@RequestMapping(value="/{status}",  method = RequestMethod.GET)
	public String process(@PathVariable String status) throws SchedulerException {
		log.info("status: " + status);
		if (status.equals("start")) {
			rateFeeder.start();
		}
		return "redirect:ratefeeder";
	}
}
