package com.mgwvalas.json.io;

import java.util.List;

import junit.framework.Assert;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesJsonFileReader;

public class When_read_kurs_file {
	private RatesJsonFileReader _ratesJsonFileReader;
	
	@Before
	public void setUp() {
		String path = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\chf.json";
		_ratesJsonFileReader = new RatesJsonFileReader(path);
	}
	
	@Test
	public void sould_load_as_rate_list() {
		List<RateLog> rates = _ratesJsonFileReader.readRates();
		Assert.assertEquals(2, rates.size());
	}
}
