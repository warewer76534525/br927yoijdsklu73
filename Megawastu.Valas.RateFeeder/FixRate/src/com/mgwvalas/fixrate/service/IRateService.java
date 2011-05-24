package com.mgwvalas.fixrate.service;

import java.util.List;

import com.mgwvalas.moneychanger.domain.Rate;

public interface IRateService {
	public void save(List<Rate> rates);
}
