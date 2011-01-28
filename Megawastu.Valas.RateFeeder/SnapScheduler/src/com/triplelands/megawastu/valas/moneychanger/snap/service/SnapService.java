package com.triplelands.megawastu.valas.moneychanger.snap.service;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public class SnapService {
	protected Log log = LogFactory.getLog(getClass());
	private List<String> currencyListForSnap = new ArrayList<String>();
	private Rates rates = new Rates(); 

	public SnapService() {
		log.info("SNAP service created");
	}

	public void setCurrencyListForSnap(List<String> currencyListForSnap) {
		this.currencyListForSnap = currencyListForSnap;
	}

	public void update(Rates _rates) {
		List<Rate> listRates = _rates.getRates();
		Iterator<Rate> rateIterator = listRates.iterator();
		while (rateIterator.hasNext()) {
			Rate rate = rateIterator.next();
			String currency = rate.getCurrency();
			
			//remove rate when the currency is not in snap list
			if (!currencyListForSnap.contains(currency)) {
				rateIterator.remove();
				log.debug("remove rate: " + rate);
			}
		}
		
		rates = _rates;
		log.info("incoming from publisher: " + rates);
	}
	
	public void generate() {
		log.info("publish sintesis: " + rates);
	}

}
