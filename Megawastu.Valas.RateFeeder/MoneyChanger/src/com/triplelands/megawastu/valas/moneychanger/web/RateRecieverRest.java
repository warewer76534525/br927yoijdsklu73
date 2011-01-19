package com.triplelands.megawastu.valas.moneychanger.web;

import static org.springframework.http.HttpStatus.CREATED;
import static org.springframework.web.bind.annotation.RequestMethod.GET;
import static org.springframework.web.bind.annotation.RequestMethod.POST;

import javax.servlet.http.HttpServletResponse;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.ResponseStatus;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;
import com.triplelands.megawastu.valas.moneychanger.service.IRateService;

@Controller
@RequestMapping("/rest/rates")
public class RateRecieverRest {
	
	protected Log log = LogFactory.getLog(RateRecieverRest.class);
	private IRateService rateService;
	
	
	@Autowired
    public void setRateService(IRateService rateService) {
		this.rateService = rateService;
	}

	@RequestMapping(method = POST)
    @ResponseStatus(CREATED)
    public void recieveRates(@RequestBody Rates rates,
            HttpServletResponse response) {
		rateService.save(rates.getRates());
        log.info("rates: " + rates);
    }

    @RequestMapping( method = GET)
    @ResponseBody
    public Rates rates() {
    	Rates rates = new Rates();
    	
    	Rate idr = new Rate("IDR", 0, 0);
    	Rate aud = new Rate("AUD", 3, 2);
    	Rate yui = new Rate("YUI", 5, 6);
    	
    	rates.addRate(idr);
    	rates.addRate(yui);
    	rates.addRate(aud);
    	log.info("rates: " + rates);
        return rates;
    }
    
}