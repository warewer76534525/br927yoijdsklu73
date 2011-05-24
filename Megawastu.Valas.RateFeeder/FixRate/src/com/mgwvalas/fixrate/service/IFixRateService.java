package com.mgwvalas.fixrate.service;

import com.mgwvalas.moneychanger.domain.Rates;

public interface IFixRateService {
	void update(Rates rates);
	void serialize();
	void reset();
	void stale();
	void notStale();
}
