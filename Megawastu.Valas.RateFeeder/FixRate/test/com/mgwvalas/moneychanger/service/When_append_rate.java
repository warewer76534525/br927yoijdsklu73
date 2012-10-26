package com.mgwvalas.moneychanger.service;

import java.util.Date;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.service.RateLogAppender;

public class When_append_rate {
	private RateLogAppender rateLogAppender;
	private RateLog _rateLog;
	
	@Before
	public void setUp() {
		String jsonFile = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		String stockChartFile = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		rateLogAppender = new RateLogAppender(jsonFile, stockChartFile);
		
		_rateLog = new RateLog("CHF", 1.3452, 1.2234, new Date());
	}
	
	@Test
	public void should_append_the_rate_to_stock_chart_file() {
		rateLogAppender.log(_rateLog);
	}
}
