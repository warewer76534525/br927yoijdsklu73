package com.mgwvalas.snap.service;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import javax.annotation.PostConstruct;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;
import com.mgwvalas.snap.dao.ICurrencyDao;

@Service
public class SnapService {
	protected Log log = LogFactory.getLog(getClass());
	
	private List<String> currencyListForSnap = new ArrayList<String>();
	private Rates rates = new Rates();
	private boolean _stale = true;
	private boolean _holiday = false;

	@Autowired
	ICurrencyDao currencyDao;

	@Autowired
	private IMessagePublisher<Rates> snapUpdatedPublisher;

	public SnapService() {
		log.info("SNAP service created");
	}
	
	@PostConstruct
	public void init() {
		currencyListForSnap = currencyDao.findSnapCurrency();
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

			// remove rate when the currency is not in snap list
			if (!currencyListForSnap.contains(currency)) {
				rateIterator.remove();
				log.debug("remove rate: " + rate);
			}
		}

		rates = _rates;
		log.info("incoming from publisher: " + rates);
	}

	public void publish() {
		log.info("publish snap rates"+ rates);
		snapUpdatedPublisher.publish(rates);
	}

	public List<String> getCurrencyListForSnap() {
		return currencyListForSnap;
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

	public void holiday() {
		_holiday = true;
	}

	public void notHoliday() {
		_holiday = false;
	}

	public boolean isHoliday() {
		return _holiday;
	}

}
