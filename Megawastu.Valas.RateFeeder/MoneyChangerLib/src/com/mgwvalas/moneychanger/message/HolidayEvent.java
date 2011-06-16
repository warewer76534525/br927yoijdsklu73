package com.mgwvalas.moneychanger.message;

import java.io.Serializable;

public class HolidayEvent implements Serializable {
	
	private static final long serialVersionUID = 1L;
	private boolean _holiday;
	
	public HolidayEvent(boolean holiday) {
		_holiday = holiday;
	}
	
	public boolean isHoliday() {
		return _holiday;
	}
}
