package com.mgwvalas.fixrate.service;

import com.mgwvalas.fixrate.domain.FixRates;
import com.mgwvalas.moneychanger.domain.Rates;

public interface IFixRateService {
	FixRates getRates();
	void update(Rates rates);
	void serialize();
	void reset();
	void stale();
	void notStale();
	void holiday();
	void notHoliday();
}
