package com.mgwvalas.fixrate.domain;

import com.mgwvalas.moneychanger.domain.Rate;

public class FixRate {
	private String currency;
	private int fixed;
	private double bid;
	private double ask;
	private double lowBid;
	private double highBid;
	private double lowAsk;
	private double highAsk;

	public FixRate(String currency, int fixed) {
		this.currency = currency;
		this.setFixed(fixed);
	}
	
	public FixRate(String currency, double bid, double ask) {
		this.currency = currency;
		this.bid = bid;
		this.ask = ask;
		this.lowAsk = ask;
		this.lowBid = bid;
		this.highAsk = ask;
		this.highBid = bid;
	}
	
	public FixRate(Rate _rate) {
		this.currency = _rate.getCurrency();
		this.bid = _rate.getBid();
		this.ask = _rate.getAsk();
		this.lowAsk = ask;
		this.lowBid = bid;
		this.highAsk = ask;
		this.highBid = bid;
	}

	public void update(double _bid, double _ask) {
		
		if (isReset()) {
			lowAsk = _ask;
			highAsk = _ask;
			lowBid = _bid;
			highBid = _bid;
		}
			
		
		if (!isCurrentBidLowerThan(_bid)) {
			lowBid = _bid;
		}

		if (!isCurrentBidHigherThan(_bid)) {
			highBid = _bid;
		}

		if (!isCurrentAskLowerThan(_ask)) {
			lowAsk = _ask;
		}

		if (!isCurrentAskHigherThan(_ask)) {
			highAsk = _ask;
		}

		bid = _bid;
		ask = _ask;
	}

	private boolean isReset() {
		return highAsk == 0 && highBid == 0 && lowAsk == 0 && lowBid == 0; 
	}

	private boolean isCurrentBidHigherThan(double _bid) {
		return highBid > _bid;
	}

	private boolean isCurrentBidLowerThan(double _bid) {
		return lowBid < _bid;
	}

	private boolean isCurrentAskHigherThan(double _ask) {
		return highAsk > _ask;
	}

	private boolean isCurrentAskLowerThan(double _ask) {
		return lowAsk < _ask;
	}

	public double getLowBid() {
		return lowBid;
	}

	public double getHighwBid() {
		return highBid;
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

	public String getCurrency() {
		return currency;
	}

	public int getFixed() {
		return fixed;
	}

	public void setFixed(int fixed) {
		this.fixed = fixed;
	}

	@Override
	public String toString() {
		return "FixRate [currency=" + currency + ", fixed=" + fixed + ", bid="
				+ bid + ", ask=" + ask + ", lowBid=" + lowBid + ", highBid="
				+ highBid + ", lowAsk=" + lowAsk + ", highAsk=" + highAsk + "]";
	}

	
}
