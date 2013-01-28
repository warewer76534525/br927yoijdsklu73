package com.mgwvalas.moneychanger.web;

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

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;

@Controller
@RequestMapping("/rest/rates")
public class RateRecieverRest {

	protected Log log = LogFactory.getLog(RateRecieverRest.class);

	private IMessagePublisher<Rates> ratesUpdatedPublisher;
	
	@Autowired
	public void setRatesUpdatedPublisher(
			IMessagePublisher<Rates> ratesUpdatedPublisher) {
		this.ratesUpdatedPublisher = ratesUpdatedPublisher;
	}

	@RequestMapping(method = POST)
	@ResponseStatus(CREATED)
	public void recieveRates(@RequestBody Rates rates,
			HttpServletResponse response) {
		log.info("rates: " + rates);
		ratesUpdatedPublisher.publish(rates);
	}

	@RequestMapping(method = GET)
	@ResponseBody
	public Rates rates() {
		Rates rates = new Rates();

		Rate idr = new Rate("IDR", 0, 0);
		Rate aud = new Rate("AUD", 3, 2);
		Rate yui = new Rate("YUI", 5, 6);

		rates.addRate(idr);
		rates.addRate(yui);
		rates.addRate(aud);
		ratesUpdatedPublisher.publish(rates);
		log.info("rates: " + rates);
		
		return rates;
	}

}
