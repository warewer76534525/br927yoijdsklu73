package com.mgwvalas.json.io;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Random;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesStockChartFileWriter;

public class When_write_kurs_stock_chart {
	
	private RatesStockChartFileWriter _ratesStockChartFileWriter;
	private List<RateLog> _ratesLogs = new ArrayList<RateLog>();
	
	@Before
	public void Before() {
		Date now = new Date();
		String path = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		_ratesStockChartFileWriter = new RatesStockChartFileWriter(path, "CHF");
		
		double min = 1.9999;
		Random r = new Random();
		
		for (int i = 0; i < 20; i++) {
			double bid = r.nextDouble() + min;
			double ask = bid + 0.2;
			
			Calendar calendar = Calendar.getInstance();
			calendar.add(Calendar.HOUR, i);
			
			_ratesLogs.add(new RateLog("CHF", bid, ask, calendar.getTime()));
		}
	}
	
	@Test
	public void shuld_write_with_specific_format() {
	    long start = System.currentTimeMillis();
		try {
			_ratesStockChartFileWriter.write(_ratesLogs);
		} catch (IOException e) {
			
			e.printStackTrace();
		}
		long finish = System.currentTimeMillis();
		System.out.print( finish - start );
		System.out.println(" milliseconds");
	}
}
