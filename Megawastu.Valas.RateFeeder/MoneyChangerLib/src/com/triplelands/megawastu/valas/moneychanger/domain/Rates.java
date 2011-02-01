package com.triplelands.megawastu.valas.moneychanger.domain;

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
	 * update rate if contain the parameterize rate
	 * add rate to list if not exists
	 * 
	 **/
	public void update(Rate _rate) {
		boolean updated =  false;
		
		for (Rate rate : rates) {
			if (rate.getCurrency().equals(_rate.getCurrency())) {
				rate.setAsk(_rate.getAsk());
				rate.setBid(_rate.getBid());
				
				updated = true;
			}
		}
		
		//if rate is not updated
		if (!updated) {
			rates.add(_rate);
		}
	}

	@Override
	public String toString() {
		return "Rates [rates=" + rates + "]";
	}

}
