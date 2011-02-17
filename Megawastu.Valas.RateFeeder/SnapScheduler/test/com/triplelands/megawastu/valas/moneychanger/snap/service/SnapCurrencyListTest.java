package com.triplelands.megawastu.valas.moneychanger.snap.service;

import java.util.List;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "classpath:application-context.xml")
public class SnapCurrencyListTest {

	@Autowired
	SnapService snapService;
	
	Rates rates = new Rates();

	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
		
	}

	@Test
	public void should_return_currency_list_for_snap_when_snap_service_constructed() {
		List<String> currencyForSnap = snapService.getCurrencyListForSnap();
		Assert.assertNotSame(0, currencyForSnap.size());
	}

}
