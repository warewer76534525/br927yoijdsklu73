package com.mgwvalas.fixrate.service;

import java.io.File;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.io.RatesJsonFileReader;
import com.mgwvalas.fixrate.io.RatesJsonFileWriter;
import com.mgwvalas.fixrate.io.RatesStockChartFileWriter;

public class RateLogAppender {
	protected Log log = LogFactory.getLog(getClass());
	
	private String basePath;
	private String stockChartBasePath;
	
	public RateLogAppender(String basePath, String stockChartBasePath) {
		this.basePath = basePath;
		this.stockChartBasePath = stockChartBasePath;
	}
	
	public void log(RateLog rate) {
		try {
			List<RateLog> rates = new ArrayList<RateLog>();
    		String fileName = rate.getCurrency() + ".json";
    		
    		File currFile = new File(basePath, fileName);
    		
    		if (currFile.exists()) {
    			RatesJsonFileReader reader = new RatesJsonFileReader(currFile.getAbsolutePath());
    			List<RateLog> readRates = reader.readRates();
    			if (readRates.size() > 0)
    				rates = readRates;
    		}
    			
    		RatesJsonFileWriter writer = new RatesJsonFileWriter(currFile.getAbsolutePath());
    		
    		RatesStockChartFileWriter stockChartFileWriter = new RatesStockChartFileWriter(stockChartBasePath, rate.getCurrency());
    		RateLog currentRate = new RateLog(rate.getCurrency(), rate.getBid(), rate.getAsk(), new Date());
    		rates.add(currentRate);
    		
    		writer.write(rates);
    		stockChartFileWriter.write(rates);
		} catch (Exception e) {
			log.error(e.getStackTrace(), e);
		} 
	}
}
