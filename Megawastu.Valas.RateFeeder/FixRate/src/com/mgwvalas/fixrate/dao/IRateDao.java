package com.mgwvalas.fixrate.dao;

import java.util.List;

import com.mgwvalas.moneychanger.domain.Rate;

public interface IRateDao {
	public void save(List<Rate> rates);
	public List<Rate> findLatestRates();
}
