package com.triplelands.megawastu.valas.fixrate.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.triplelands.megawastu.valas.fixrate.dao.IRateDao;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

@Service
@Transactional(readOnly=true)
public class RateService implements IRateService {
	@Autowired
	private IRateDao rateDao;
	
	@Transactional(readOnly=false)
	@Override
	public void save(List<Rate> rates) {
		rateDao.save(rates);
	}

}
