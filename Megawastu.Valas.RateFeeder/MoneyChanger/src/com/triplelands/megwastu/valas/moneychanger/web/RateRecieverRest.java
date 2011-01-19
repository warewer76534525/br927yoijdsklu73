package com.triplelands.megwastu.valas.moneychanger.web;

import static org.springframework.http.HttpStatus.CREATED;
import static org.springframework.web.bind.annotation.RequestMethod.GET;
import static org.springframework.web.bind.annotation.RequestMethod.POST;

import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletResponse;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.ResponseStatus;

import com.triplelands.megwastu.valas.moneychanger.domain.Rate;

@Controller
@RequestMapping("/rest/rates")
public class RateRecieverRest {
	
	protected Log log = LogFactory.getLog(RateRecieverRest.class);
	
    @RequestMapping(method = POST)
    @ResponseStatus(CREATED)
    public void recieveRates(@RequestBody List<Rate> rates,
            HttpServletResponse response) {
		System.out.println(rates.size());
		System.out.println(rates);
        log.info(">>>" + rates.size());
        log.info(">>>" + rates);
    }

    @RequestMapping( method = GET)
    @ResponseBody
    public List<Rate> rates() {
    	List<Rate> rates = new ArrayList<Rate>();
    	
    	Rate idr = new Rate("IDR", 0, 0);
    	Rate aud = new Rate("AUD", 3, 2);
    	Rate yui = new Rate("YUI", 5, 6);
    	
    	rates.add(idr);
    	rates.add(yui);
    	rates.add(aud);
        return rates;
    }


}
