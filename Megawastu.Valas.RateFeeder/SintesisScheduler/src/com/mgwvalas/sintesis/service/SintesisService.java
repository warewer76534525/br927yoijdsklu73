package com.mgwvalas.sintesis.service;

import java.util.ArrayList;
import java.util.List;

import javax.annotation.PostConstruct;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;
import com.mgwvalas.sintesis.dao.ICurrencyDao;
import com.mgwvalas.sintesis.domain.CurrencySintz;
import com.mgwvalas.sintesis.domain.CurrencySintzRepository;

@Service
public class SintesisService {
	protected Log log = LogFactory.getLog(getClass());
	private List<String> currencyListForSintesis = new ArrayList<String>();
	private Rates freshRates = new Rates();
	private boolean _stale = true;

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

		log.info("$$$$ generate sintesis value"
				+ currencySintzRepository.sitesisResults());
	}

	public List<String> getCurrencyListForSintesis() {
		return currencyListForSintesis;
	}

	public void stale() {
		_stale = true;
	}

	public void notStale() {
		_stale = false;
	}
	
	public boolean isStale() {
		return _stale;
	}

}
