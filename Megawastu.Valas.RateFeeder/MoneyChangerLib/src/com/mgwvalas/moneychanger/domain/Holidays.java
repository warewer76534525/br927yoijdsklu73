package com.mgwvalas.moneychanger.domain;

public class Holidays {
	private int day;
	private int month;

	public Holidays(int day, int month) {
		super();
		this.day = day;
		this.month = month;
	}

	public int getDay() {
		return day;
	}

	public void setDay(int day) {
		this.day = day;
	}

	public int getMonth() {
		return month;
	}

	public void setMonth(int month) {
		this.month = month;
	}

}
