package com.triplelands.megawastu.valas.moneychanger.domain;

import java.io.Serializable;

import com.thoughtworks.xstream.annotations.XStreamAlias;

@SuppressWarnings("serial")
@XStreamAlias("customer")
public class Rate implements Serializable {
	private String currency;
	private double bid;
	private double ask;
	
	public Rate() {
		
	}
	
	public Rate(String currency, double bid, double ask) {
		super();
		this.currency = currency;
		this.bid = bid;
		this.ask = ask;
	}

	public String getCurrency() {
		return currency;
	}

	public void setCurrency(String currency) {
		this.currency = currency;
	}

	public double getBid() {
		return bid;
	}

	public void setBid(double bid) {
		this.bid = bid;
	}

	public double getAsk() {
		return ask;
	}

	public void setAsk(double ask) {
		this.ask = ask;
	}

	@Override
	public String toString() {
		return "Rate [currency=" + currency + ", bid=" + bid + ", ask=" + ask
				+ "]";
	}

	public Rate calculateAskSintesis(Rate previous) {
		return new Rate(currency, bid, (this.ask + previous.ask) /2 );
	}

	public void copyFrom(Rate rate) {
		bid = rate.bid;
		ask = rate.ask;
	}

	public Rate calculateBidSintesis(Rate previous) {
		return new Rate(currency, (this.bid + previous.bid) /2 , ask);
	}

	public Rate copy() {
		return new Rate(currency, bid, ask);
	}

}
