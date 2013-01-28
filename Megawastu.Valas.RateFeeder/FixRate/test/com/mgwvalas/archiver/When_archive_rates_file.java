package com.mgwvalas.archiver;

import java.io.File;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Random;

import org.junit.Before;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesJsonFileWriter;

public class When_archive_rates_file {
	private String basePath;
	private String currency;
	
	@Before
	public void setUp() {
		try {
			
			basePath = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\chf.json";
			currency = "CHF";
			InitDummyData();
			
			new RateLogsArchiver(basePath, currency);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	private void InitDummyData() throws Exception {
		String path = new File(basePath, currency).getAbsolutePath();
		RatesJsonFileWriter _ratesJsonFIleWriter = new RatesJsonFileWriter(path);
		
		ArrayList<RateLog> rates = new ArrayList<RateLog>();
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
		
		_ratesJsonFIleWriter.write(rates);
	}
}
