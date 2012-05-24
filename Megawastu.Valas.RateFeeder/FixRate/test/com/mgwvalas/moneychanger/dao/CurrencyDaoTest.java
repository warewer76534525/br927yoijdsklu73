package com.mgwvalas.moneychanger.dao;

import java.util.ArrayList;
import java.util.List;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.google.gson.Gson;
import com.mgwvalas.fixrate.dao.ICurrencyDao;
import com.mgwvalas.fixrate.domain.FixRate;
import com.mgwvalas.moneychanger.domain.Rate;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "/application-context.xml")
public class CurrencyDaoTest {
	ICurrencyDao currencyDao;
	
	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
	}

	@Autowired
	public void setRateDao(ICurrencyDao currencyDao) {
		this.currencyDao = currencyDao;
	}
	
	@Test
	public void should_save_rates_in_batch_update() {
		List<FixRate> rates = currencyDao.queryCurrencyPairs();
		System.out.println(rates);
		Gson gson = new Gson();
		System.out.println(gson.toJson(rates));
	}
}
