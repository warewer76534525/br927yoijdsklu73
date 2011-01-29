package com.triplelands.megawastu.valas.fixrate.dao;

import java.util.List;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

public interface IRateDao {
	public void save(List<Rate> rates);
	public List<Rate> findLatestRates();
}
