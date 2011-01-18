package com.triplelands.megwastu.valas.moneychanger.dao;

import java.util.List;

import com.triplelands.megwastu.valas.moneychanger.domain.Rate;

public interface IRateDao {
	public void save(List<Rate> rates);
}
