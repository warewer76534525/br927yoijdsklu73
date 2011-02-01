package com.triplelands.megawastu.valas.moneychanger.sintesis.service;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;

import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public class SintesisService {
	protected Log log = LogFactory.getLog(getClass());
	private List<String> currencyListForSintesis = new ArrayList<String>();
	private Rates freshRates = new Rates();
	private Rates sintesisRates = new Rates();
	private Rates prevSintesisRates = new Rates();

	@Autowired
	private IMessagePublisher<Rates> snapUpdatedPublisher;

	public void setCurrencyListForSintesis(List<String> currencyListForSnap) {
		this.currencyListForSintesis = currencyListForSnap;
	}

	public void update(Rates _rates) {
		freshRates = filterCurrencyForSintesis(_rates);
	}

	private Rates filterCurrencyForSintesis(Rates _rates) {
		List<Rate> listRates = _rates.getRates();
		List<Rate> filteredList = new ArrayList<Rate>();
		
		for (Rate rate : listRates) {
			if (!currencyListForSintesis.contains(rate.getCurrency())) 
				continue;
			filteredList.add(rate);
		}
		
		return new Rates(filteredList);
	}

	public void publish() {
		snapUpdatedPublisher.publish(sintesisRates);
	}
	
	public void generateSintesis() {
		Iterator<Rate> freshRatesIterator = freshRates.getRates().iterator();
		
		while (freshRatesIterator.hasNext()) {
			Rate freshRate = freshRatesIterator.next();
			Rate sintesisRate = getSintesisRate(freshRate.getCurrency());
			Rate prevSintesisRate = getPrevSintesisRate(freshRate.getCurrency());
			
			if (sintesisRate == null) {
				sintesisRates.update(freshRate);
			} else {
				//kalo nilai fresh bid sama dengan nilai sintesis dan prev sintesis adalah null
				if (freshRate.getBid() == sintesisRate.getBid() && prevSintesisRate != null) {
					double tempBid = (sintesisRate.getBid() + prevSintesisRate.getBid()) / 2;
					prevSintesisRate.setBid(sintesisRate.getBid());
					sintesisRate.setBid(tempBid);
				} else {
					//update prevsintesis rate dengan nilai sintesis, update nilai sintesis dengan fresh rate
					//log.info("set prev dengan nilai sintesis");
					if (prevSintesisRate == null) {
						prevSintesisRate = new Rate();
						prevSintesisRate.setCurrency(sintesisRate.getCurrency());
					}
					prevSintesisRate.setBid(sintesisRate.getBid());
					sintesisRate.setBid(freshRate.getBid());
					
					prevSintesisRates.update(prevSintesisRate);
				}
				
				//kalo nilai fresh ask sama dengan nilai sintesis dan prev sintesis adalah null
				if (freshRate.getAsk() == sintesisRate.getAsk() && prevSintesisRate != null) {
					double tempAsk = (sintesisRate.getAsk() + prevSintesisRate.getAsk()) / 2;
					prevSintesisRate.setAsk(sintesisRate.getAsk());
					sintesisRate.setAsk(tempAsk);
				} else {
					//update prevsintesis rate dengan nilai sintesis, update nilai sintesis dengan fresh rate
					//log.info("set prev dengan nilai sintesis");
					if (prevSintesisRate == null) {
						prevSintesisRate = new Rate();
						prevSintesisRate.setCurrency(sintesisRate.getCurrency());
					}
					prevSintesisRate.setAsk(sintesisRate.getAsk());
					sintesisRate.setAsk(freshRate.getAsk());
					
					prevSintesisRates.update(prevSintesisRate);
				}
				
			}
			
		}
		
		log.info("$$$$ sintesis value" + sintesisRates);
		log.info("$$$$ prev sintesis value" + prevSintesisRates);

	}
	
	private Rate getSintesisRate(String currency) {
		Rate rate = null;
		Iterator<Rate> sintesisIterator = sintesisRates.getRates().iterator();
		while (sintesisIterator.hasNext()) {
			Rate _rate =  sintesisIterator.next();
			if (currency.equals(_rate.getCurrency())) {
				rate = _rate;	
			}
		}
		
		return rate;
	}
	
	private Rate getPrevSintesisRate(String currency) {
		Rate rate = null;
		Iterator<Rate> prevSintesisIterator = prevSintesisRates.getRates().iterator();
		while (prevSintesisIterator.hasNext()) {
			Rate _rate =  prevSintesisIterator.next();
			if (currency.equals(_rate.getCurrency())) {
				rate = _rate;	
			}
		}
		
		return rate;
	}
}
