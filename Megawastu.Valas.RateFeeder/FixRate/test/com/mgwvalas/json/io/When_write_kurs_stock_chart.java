package com.mgwvalas.json.io;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesStockChartFileWriter;

public class When_write_kurs_stock_chart {
	
	private RatesStockChartFileWriter _ratesStockChartFileWriter;
	private List<RateLog> _ratesLogs = new ArrayList<RateLog>();
	
	@Before
	public void Before() {
		String path = "D:\\project\\triplelands\\moneychanger\\Megawastu.Valas.RateFeeder\\FixRate\\test\\resource\\";
		_ratesStockChartFileWriter = new RatesStockChartFileWriter(path, "CHF");
		
		for (int i = 0; i < 53568; i++) {
			Calendar calendar = Calendar.getInstance();
			calendar.add(Calendar.HOUR, i);
			_ratesLogs.add(new RateLog("CHF", 2.4564, 2.6321, calendar.getTime()));
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
