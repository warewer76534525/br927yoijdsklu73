package com.mgwvalas.archiver;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.domain.RateLogFilter;

public class RateLogArchiverFilter {
	private int archiveLimit;
	
	public RateLogArchiverFilter() {
		
	}
	
	public RateLogArchiverFilter(int archiveLimit) {
		this.archiveLimit = archiveLimit;
	}
	
	public RateLogFilter filter(List<RateLog> rateLogs) {
		List<RateLog> existingRateLogs = new ArrayList<RateLog>();
		List<RateLog> oldRateLogs = new ArrayList<RateLog>();
		
		Calendar calendar = Calendar.getInstance();
		calendar.add(Calendar.MONTH, -archiveLimit);
		
		for (RateLog rate : rateLogs) {
			if (rate.getTimeStamp().compareTo(calendar.getTime()) > 0)
				existingRateLogs.add(rate);
			else
				oldRateLogs.add(rate);
		}
		
		return new RateLogFilter(rateLogs, oldRateLogs);
	}
}
