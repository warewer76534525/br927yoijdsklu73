package com.triplelands.megwastu.valas.moneychanger.domain;

import org.apache.commons.lang.builder.ToStringBuilder;

import com.thoughtworks.xstream.annotations.XStreamAlias;

@XStreamAlias("customer")
public class Rate {
	private String currency;
	private double bid;
	private double ask;

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
		return ToStringBuilder.reflectionToString(this);
	}
}
