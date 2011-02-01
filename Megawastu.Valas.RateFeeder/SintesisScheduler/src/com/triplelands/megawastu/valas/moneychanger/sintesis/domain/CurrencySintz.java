package com.triplelands.megawastu.valas.moneychanger.sintesis.domain;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

public class CurrencySintz {
	private Rate current;
	private Rate previous;
	public CurrencySintz(String currency) {
		
	}

	public void freshUpdate(Rate rate) {
		
		if (!isBeginning()) {
			previous = current;	
		}
		
//		current = current.calculateSintesis();
		
		if (rate.getAsk() == current.getAsk()) {
			current = current.calculateAskSintesis(previous);  
		} else {
			current.setAsk(rate.getAsk());	
		}
		
		if (rate.getBid() == current.getBid()) {
			current = current.calculateBidSintesis(previous);  
		} else {
			current.setBid(rate.getBid());	
		}
	}

	private boolean isBeginning() {
		return current == null;
	}

	public Rate current() {
		return current;
	}

	public Rate previous() {
		return previous;
	}

	public double sintesisValue() {
		return current.getAsk();
	}
}
