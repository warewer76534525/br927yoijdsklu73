package com.mgwvalas.moneychanger.service;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class HolidayDateChecker {
	List<Date> _holidays = new ArrayList<Date>();
	DateFormat dateFormat = new SimpleDateFormat("MM-dd");
	
	public HolidayDateChecker(String holidayList) {
		String[] holidays = holidayList.split(",");
		
		for (String holiday : holidays) {
			try {
				_holidays.add(dateFormat.parse(holiday.trim()));
			} catch (ParseException e) {
				e.printStackTrace();
			}
		}
	}
	
	public boolean isTodayHoliday() {
		Date now = new Date();
		String d = dateFormat.format(now);
		
		try {
			now = dateFormat.parse(d);
		} catch (ParseException e) {
		}
		
		for (Date holiday : _holidays) {
			if (now.compareTo(holiday) == 0) {
				return true;
			}
		}
		
		return false;
	}
}
