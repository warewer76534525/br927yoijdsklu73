package com.mgwvalas.fixrate.domain;

import java.util.Date;

public class RateLog {
	private int id;
	private String currency;
	private double bid;
	private double ask;
	private Date timeStamp;

	public RateLog() {
		
	}
	
	public RateLog(String currency, double bid, double ask, Date timeStamp) {
		this.currency = currency;
		this.bid = bid;
		this.ask = ask;
		this.timeStamp = timeStamp;
	}
	
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getCurrency() {
		return currency;
	}
	public void setCurrency(String curency) {
		this.currency = curency;
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
	public Date getTimeStamp() {
		return timeStamp;
	}
	public void setTimeStamp(Date timeStamp) {
		this.timeStamp = timeStamp;
	}
	
	
}
