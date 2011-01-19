package com.triplelands.megwastu.valas.moneychanger.service;

import java.util.List;

import com.triplelands.megwastu.valas.moneychanger.domain.Rate;

public interface IRateService {
	public void save(List<Rate> rates);
}
