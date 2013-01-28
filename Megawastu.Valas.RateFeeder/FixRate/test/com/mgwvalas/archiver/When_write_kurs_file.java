package com.mgwvalas.archiver;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Random;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesJsonFileWriter;

public class When_write_kurs_file {
	
	private RatesJsonFileWriter _ratesJsonFIleWriter;
	private List<RateLog> rates;
	
	@Before
	public void setUp() {
		String path = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\chf.json";
		_ratesJsonFIleWriter = new RatesJsonFileWriter(path);
		
		rates = new ArrayList<RateLog>();
		double min = 1.9999;

		Random r = new Random();
		
		Calendar calendar = Calendar.getInstance();
		calendar.add(Calendar.MONTH, 3);
		
		for (int i = 0; i < 75; i++) {
			double bid = r.nextDouble() + min;
			double ask = bid + 0.2;
			
			calendar.add(Calendar.MONTH, 1);
			RateLog chf = new RateLog("CHF", bid, ask, calendar.getTime());
			rates.add(chf);
		}
		
		try{
			_ratesJsonFIleWriter.write(rates);
		} catch (Exception e) {
			// TODO: handle exception
		}
	}
	
	@Test
	public void Should_write_kurs_as_json_file() {
		try {
			
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
