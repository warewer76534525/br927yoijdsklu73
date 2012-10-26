package com.mgwvalas.moneychanger.service;

import java.util.ArrayList;
import java.util.List;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.service.RatesBatchLogAppender;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;


public class When_append_rates_update {
	
	private RatesBatchLogAppender _ratesBatchLogAppender;
	private List<Rate> _rates;
	
	@Before
	public void before() {
		_rates = new ArrayList<Rate>();
		
		Rate usdIDR = new Rate("USDIDR", 9000, 9050);
		Rate eurUSD = new Rate("EURUSD", 1.3000, 1.3500);
		Rate usdCHF = new Rate("USDCHF", 2.6000, 2.6070);
		
		_rates.add(usdIDR);
		_rates.add(eurUSD);
		_rates.add(usdCHF);
		
		
		
		String jsonFile = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		String stockChartFile = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		_ratesBatchLogAppender = new RatesBatchLogAppender(jsonFile, stockChartFile);
	}
	
	@Test
	public void Should_generate_graph_format_data() throws InterruptedException {
		_ratesBatchLogAppender.updateIncomingRates(_rates);
		
		Thread.sleep(10 * 1000);
	}
	
}
