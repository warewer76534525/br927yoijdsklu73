package com.triplelands.megawastu.valas.fixrate.service;

import java.util.List;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

public interface IRateService {
	public void save(List<Rate> rates);
}
