package com.triplelands.megwastu.valas.moneychanger.dao;

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

import com.triplelands.megawastu.valas.fixrate.dao.IRateDao;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "/application-context.xml")
public class RateDaoTest {
	IRateDao rateDao;
	List<Rate> rates = new ArrayList<Rate>();
	
	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
		
		Rate idr = new Rate("IDR", 0, 0);
    	Rate aud = new Rate("AUD", 3, 2);
    	Rate yui = new Rate("YUI", 5, 6);
    	
    	rates.add(idr);
    	rates.add(yui);
    	rates.add(aud);
	}

	@Autowired
	public void setRateDao(IRateDao rateDao) {
		this.rateDao = rateDao;
	}
	
	@Test
	public void should_save_rates_in_batch_update() {
		rateDao.save(rates);
	}
}
