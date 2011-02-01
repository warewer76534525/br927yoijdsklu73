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
		
		if (rate.getAsk() == current.getAsk()) {
			current = current.calculateSintesis(previous);  
		} else {
			current = rate;	
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
