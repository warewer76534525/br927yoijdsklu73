package com.mgwvalas.sintesis.service;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;
import com.mgwvalas.sintesis.service.SintesisService;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "classpath:application-context.xml")
public class SintesisUpdatedServiceTest {
	private SintesisService snapService;
	private Rates rates = new Rates();

	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
		
		Rate idr = new Rate("IDR", 0, 0);
    	Rate aud = new Rate("AUD", 3, 2);
    	Rate yui = new Rate("YUI", 5, 6);
    	
    	rates.addRate(yui);
    	rates.addRate(aud);
    	rates.addRate(idr);
	}

	@Autowired
	public void setSnapService(SintesisService snapService) {
		this.snapService = snapService;
	}

	@Test
	public void should_update_exists_rates() {
		snapService.update(rates);
	}
}
