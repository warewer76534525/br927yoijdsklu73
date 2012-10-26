package com.mgwvalas.fixrate.service;

import java.util.Date;
import java.util.List;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.moneychanger.domain.Rate;

@Service
public class RatesBatchLogAppender {
	protected Log log = LogFactory.getLog(getClass());
	
	@Value("${rate.directory}")
	private String jsonRatePath;
	
	@Value("${rate.directory}")
	private String stockChartPath;
	
	public RatesBatchLogAppender() {
		
	}
	
	public RatesBatchLogAppender(String jsonRatePath, String stockChartPath) {
		this.jsonRatePath = jsonRatePath;
		this.stockChartPath = stockChartPath;
	}
	
	public void updateIncomingRates(List<Rate> rates) {
		
		log.info("Begin batch log stock chart, size: " + rates.size());
		if (rates.size() == 0)
			return;
		
		ExecutorService exec = Executors.newFixedThreadPool(rates.size());
		try {
		    for (final Rate rate : rates) {
		        exec.submit(new Runnable() {
		        	
		            @Override
		            public void run() {
		            	try {
		            		RateLog current = new RateLog(rate.getCurrency(), rate.getBid(), rate.getAsk(), new Date());
		            		new RateLogAppender(jsonRatePath, stockChartPath).log(current);
						} catch (Exception e) {
							
						} 
		            }
		        });
		    }
		} finally {
		    exec.shutdown();
		    
		}
	}
	
}
