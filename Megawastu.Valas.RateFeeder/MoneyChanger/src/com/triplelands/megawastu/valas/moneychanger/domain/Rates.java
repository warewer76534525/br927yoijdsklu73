package com.triplelands.megawastu.valas.moneychanger.domain;

import java.util.ArrayList;
import java.util.List;

public class Rates {
	private List<Rate> rates = new ArrayList<Rate>();
	
	public Rates() {
		
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

	@Override
	public String toString() {
		return "Rates [rates=" + rates + "]";
	}
	
	
}
