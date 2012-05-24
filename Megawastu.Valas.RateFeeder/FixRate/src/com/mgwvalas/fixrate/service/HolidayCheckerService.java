package com.mgwvalas.fixrate.service;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.mgwvalas.fixrate.dao.IConfigurationDao;
import com.mgwvalas.moneychanger.domain.Configuration;
import com.mgwvalas.moneychanger.domain.Holidays;

@Service
public class HolidayCheckerService {

	@Autowired
	private IConfigurationDao configurationDao;

	public HolidayCheckerService() {

	}

	public boolean IsNowHoliday() {
		
		Configuration holidayConfig = configurationDao.getHolidays();
		String holidayList = holidayConfig.getValue();
		
		String[] holidayDates = holidayList.split(",");
        List<Holidays> holidays = new ArrayList<Holidays>();
        
        
        for (String holidayDate : holidayDates) {
        	String[] dateMonth = holidayDate.split("\\.");
        	
        	Holidays holiday = new Holidays(Integer.parseInt(dateMonth[0]), Integer.parseInt(dateMonth[1]));
        	holidays.add(holiday);
		}
        
		return true;
	}

}
