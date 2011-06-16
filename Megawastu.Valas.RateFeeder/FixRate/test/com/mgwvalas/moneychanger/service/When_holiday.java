package com.mgwvalas.moneychanger.service;

import junit.framework.Assert;

import org.junit.Before;
import org.junit.Test;


public class When_holiday {
	private String holidays;
	private HolidayDateChecker _holidayDateChecker;
	
	@Before
	public void setUp() {
		holidays = "06-15, 01-01";
		_holidayDateChecker =  new HolidayDateChecker(holidays);
	}
	
	@Test
	public void should_return_true_if_holiday() {
		Assert.assertTrue(_holidayDateChecker.isTodayHoliday());
	}
}
