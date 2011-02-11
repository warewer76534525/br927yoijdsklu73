package com.triplelands.megawastu.valas.fixrate.service;

import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public interface IFixRateService {
	void update(Rates rates);
	void serialize();
	void reset();
}
