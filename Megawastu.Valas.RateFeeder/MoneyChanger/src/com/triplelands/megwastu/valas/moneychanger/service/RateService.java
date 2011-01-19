package com.triplelands.megwastu.valas.moneychanger.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.triplelands.megwastu.valas.moneychanger.dao.IRateDao;
import com.triplelands.megwastu.valas.moneychanger.domain.Rate;

@Service("rateService")
@Transactional(readOnly=true)
public class RateService implements IRateService {
	IRateDao rateDao;
	
	@Autowired
	public void setRateDao(IRateDao rateDao) {
		this.rateDao = rateDao;
	}

	@Transactional(readOnly=false)
	@Override
	public void save(List<Rate> rates) {
		rateDao.save(rates);
	}

}