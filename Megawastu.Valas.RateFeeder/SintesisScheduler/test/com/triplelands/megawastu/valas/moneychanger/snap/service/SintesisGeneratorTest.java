package com.triplelands.megawastu.valas.moneychanger.snap.service;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;
import com.triplelands.megawastu.valas.moneychanger.sintesis.service.SintesisService;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "classpath:application-context.xml")
public class SintesisGeneratorTest {
	private SintesisService snapService;
	private Rates rates = new Rates();

	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		Logger.getLogger("org.quartz.core.QuartzScheduler").setLevel(Level.WARN);
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
	public void should_generate_sintesis_value_when_sintesis_rate_is_null() {
		snapService.update(rates);
		snapService.generateSintesis();
	}
	
	@Test
	public void should_generate_sintesis_value_when_sintesis_rate_is__not_null() {
		Rate idr = new Rate("IDR", 5, 5);
		snapService.update(rates);
		snapService.generateSintesis();
		
		
		rates.update(idr);
		snapService.update(rates);
		snapService.generateSintesis();
	}
	
	@Test
	public void should_generate_sintesis_value_when_when_perv_same_with_current_sintesis() {
		Rates _rates = new Rates();
		Rate idr = new Rate("IDR", 0, 0);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
		
		_rates = new Rates();
		idr = new Rate("IDR", 5, 5);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
		
		System.out.println("------------------------");
		_rates = new Rates();
		idr = new Rate("IDR", 5, 5);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
	}
	
	@Test
	public void should_generate_sintesis_value_when_when_perv_same_with_current_sintesis_again() {
		Rates _rates = new Rates();
		Rate idr = new Rate("IDR", 0, 0);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
		
		_rates = new Rates();
		idr = new Rate("IDR", 5, 6);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
		
		_rates = new Rates();
		idr = new Rate("IDR", 5, 6);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
		
		System.out.println("__________________________________");
		_rates = new Rates();
		idr = new Rate("IDR", 5, 6);
		_rates.addRate(idr);
		snapService.update(_rates);
		snapService.generateSintesis();
	}
}
