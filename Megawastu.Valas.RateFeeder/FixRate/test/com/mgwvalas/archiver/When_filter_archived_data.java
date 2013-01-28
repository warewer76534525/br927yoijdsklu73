package com.mgwvalas.archiver;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;

public class When_filter_archived_data {
	
	private final int ARCHIVED_LIMIT = 2;
	private List<RateLog> _rates;
	
	@Before
	public void setUp() {
		_rates = new ArrayList<RateLog>();
		Calendar calendar = Calendar.getInstance();
		calendar.set(2012, 1, 1);
		
		for (int i = 0; i < 90; i++) {
			_rates.add(new RateLog("USD", 1, 1, calendar.getTime()));
			calendar.add(Calendar.DATE, 1);
		}
	}
	
	@Test
	public void should_collect_existing_data() {
		
		List<RateLog> rates = new ArrayList<RateLog>();
		
		Calendar calendar = Calendar.getInstance();
		calendar.set(2012, 3, 30);
		calendar.add(Calendar.MONTH, -ARCHIVED_LIMIT);
		
		System.out.println("Seletected Time: " + calendar.getTime());
		
		for (RateLog rate : _rates) {
			if (rate.getTimeStamp().compareTo(calendar.getTime()) > 0)
				rates.add(rate);
		}
		
		for (RateLog rate : rates) {
			System.out.println(rate.getTimeStamp());
		}
		
	}
	
	@Test
	public void should_archived_old_data() {
		List<RateLog> archived = new ArrayList<RateLog>();
		
		Calendar calendar = Calendar.getInstance();
		calendar.set(2012, 3, 30);
		calendar.add(Calendar.MONTH, -ARCHIVED_LIMIT);
		
		System.out.println("Seletected Time: " + calendar.getTime());
		
		for (RateLog rate : _rates) {
			if (rate.getTimeStamp().compareTo(calendar.getTime()) <= 0)
				archived.add(rate);
		}
		
		for (RateLog rate : archived) {
			System.out.println(rate.getTimeStamp());
		}
	}
}
