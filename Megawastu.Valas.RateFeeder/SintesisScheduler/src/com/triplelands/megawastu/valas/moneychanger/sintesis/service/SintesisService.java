package com.triplelands.megawastu.valas.moneychanger.sintesis.service;

import java.util.ArrayList;
import java.util.List;

import javax.annotation.PostConstruct;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.triplelands.megawastu.valas.moneychanger.dao.ICurrencyDao;
import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;
import com.triplelands.megawastu.valas.moneychanger.sintesis.domain.CurrencySintz;
import com.triplelands.megawastu.valas.moneychanger.sintesis.domain.CurrencySintzRepository;

@Service
public class SintesisService {
	protected Log log = LogFactory.getLog(getClass());
	private List<String> currencyListForSintesis = new ArrayList<String>();
	private Rates freshRates = new Rates();

	@Autowired
	private CurrencySintzRepository currencySintzRepository;

	@Autowired
	private IMessagePublisher<Rates> snapUpdatedPublisher;

	@Autowired
	private ICurrencyDao currencyDao;

	public void setCurrencyListForSintesis(List<String> currencyListForSnap) {
		this.currencyListForSintesis = currencyListForSnap;
	}

	@PostConstruct
	public void init() {
		currencyListForSintesis = currencyDao.findSintesisCurrency();
		log.info("INIT currencyListForSintesis: " + currencyListForSintesis);
	}

	public void update(Rates _rates) {
		freshRates = _rates.filteredRates(currencyListForSintesis);
	}

	public void publish() {
		snapUpdatedPublisher.publish(currencySintzRepository.sitesisResults());
	}

	public void generateSintesis() {

		for (Rate freshRate : freshRates.getRates()) {
			CurrencySintz sintz = currencySintzRepository
					.findByCurrency(freshRate.getCurrency());
			sintz.freshUpdate(freshRate);
		}

		log.info("$$$$ sintesis value"
				+ currencySintzRepository.sitesisResults());
	}

	public List<String> getCurrencyListForSintesis() {
		return currencyListForSintesis;
	}

}
