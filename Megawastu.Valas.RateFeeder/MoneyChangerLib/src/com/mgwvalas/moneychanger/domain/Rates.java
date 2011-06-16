package com.mgwvalas.moneychanger.domain;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

@SuppressWarnings("serial")
public class Rates implements Serializable {

	private List<Rate> rates = new ArrayList<Rate>();

	public Rates() {

	}

	public Rates(List<Rate> rates) {
		this.rates = rates;
	}

	public List<Rate> getRates() {
		return rates;
	}

	public void setRates(List<Rate> rates) {
		this.rates = rates;
	}

	public void addRate(Rate rate) {
		rates.add(rate);
	}

	public void removeRate(Rate rate) {
		rates.remove(rate);
	}

	/**
	 * update rate if contain the parameterize rate add rate to list if not
	 * exists
	 * 
	 **/
	public void update(Rate _rate) {
		
		Rate rate = this.findRateByCurrency(_rate.getCurrency());
		
		if (rate == null) {
			rates.add(_rate);
		}
		else {
			rate.copyFrom(_rate);
		}
	}

	@Override
	public String toString() {
		return "Rates [rates=" + rates + "]";
	}

	public Rate findRateByCurrency(String currency) {
		for (Rate rate : rates) {
			if (currency.equals(rate.getCurrency())) {
				return rate;
			}
		}

		return null;
	}

	public Rates filteredRates(List<String> includeList) {
		List<Rate> listRates = getRates();
		List<Rate> filteredList = new ArrayList<Rate>();

		for (Rate rate : listRates) {
			if (!includeList.contains(rate.getCurrency()))
				continue;
			filteredList.add(rate);
		}

		return new Rates(filteredList);
	}

}
