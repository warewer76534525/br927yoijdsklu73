package com.mgwvalas.fixrate.domain;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

@SuppressWarnings("serial")
public class FixRates implements Serializable {

	private List<FixRate> rates = new ArrayList<FixRate>();
	private boolean stale;
	

	public FixRates() {

	}

	public FixRates(List<FixRate> rates) {
		this.rates = rates;
	}

	public List<FixRate> getRates() {
		return rates;
	}

	public void setRates(List<FixRate> rates) {
		this.rates = rates;
	}

	public void addRate(FixRate rate) {
		rates.add(rate);
	}

	public void removeRate(FixRate rate) {
		rates.remove(rate);
	}

	/**
	 * update rate if contain the parameterize rate add rate to list if not
	 * exists
	 * 
	 **/
	public void update(FixRate _rate) {
		FixRate rate = this.findRateByCurrency(_rate.getCurrency());
		
		if (rate == null) {
			rates.add(_rate);
		}
		else {
			rate.update(_rate.getBid(), _rate.getAsk());
		}
	}

	@Override
	public String toString() {
		return "Rates [rates=" + rates + "]";
	}

	public FixRate findRateByCurrency(String currency) {
		for (FixRate rate : rates) {
			if (currency.equals(rate.getCurrency())) {
				return rate;
			}
		}

		return null;
	}
	
	public void reset() {
		rates = new ArrayList<FixRate>();
	}
	
	public boolean isStale() {
		return stale;
	}

	public void stale() {
		stale = true;
	}
	
	public void notStale() {
		stale = false;
	}
}
