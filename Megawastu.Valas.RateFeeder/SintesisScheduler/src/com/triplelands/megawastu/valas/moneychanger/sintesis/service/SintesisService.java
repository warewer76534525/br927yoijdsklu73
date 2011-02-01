package com.triplelands.megawastu.valas.moneychanger.sintesis.service;

import java.util.ArrayList;
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
		freshRates = _rates.filteredRates(currencyListForSintesis);
	}

	public void publish() {
		snapUpdatedPublisher.publish(sintesisRates);
	}

	public void generateSintesis() {

		for (Rate freshRate : freshRates.getRates()) {
			Rate sintesisRate = sintesisRates.findRateByCurrency(freshRate.getCurrency());
			Rate prevSintesisRate = prevSintesisRates.findRateByCurrency(freshRate.getCurrency());
			
			if (sintesisRate == null) {
				sintesisRates.update(freshRate);
			} else {
				// kalo nilai fresh bid sama dengan nilai sintesis dan prev
				// sintesis adalah null
				if (freshRate.getBid() == sintesisRate.getBid()
						&& prevSintesisRate != null) {
					double tempBid = (sintesisRate.getBid() + prevSintesisRate
							.getBid()) / 2;
					prevSintesisRate.setBid(sintesisRate.getBid());
					sintesisRate.setBid(tempBid);
				} else {
					// update prevsintesis rate dengan nilai sintesis, update
					// nilai sintesis dengan fresh rate
					// log.info("set prev dengan nilai sintesis");
					if (prevSintesisRate == null) {
						prevSintesisRate = new Rate();
						prevSintesisRate
								.setCurrency(sintesisRate.getCurrency());
					}
					prevSintesisRate.setBid(sintesisRate.getBid());
					sintesisRate.setBid(freshRate.getBid());

					prevSintesisRates.update(prevSintesisRate);
				}

				// kalo nilai fresh ask sama dengan nilai sintesis dan prev
				// sintesis adalah null
				if (freshRate.getAsk() == sintesisRate.getAsk()
						&& prevSintesisRate != null) {
					double tempAsk = (sintesisRate.getAsk() + prevSintesisRate
							.getAsk()) / 2;
					prevSintesisRate.setAsk(sintesisRate.getAsk());
					sintesisRate.setAsk(tempAsk);
				} else {
					// update prevsintesis rate dengan nilai sintesis, update
					// nilai sintesis dengan fresh rate
					// log.info("set prev dengan nilai sintesis");
					if (prevSintesisRate == null) {
						prevSintesisRate = new Rate();
						prevSintesisRate
								.setCurrency(sintesisRate.getCurrency());
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
}
