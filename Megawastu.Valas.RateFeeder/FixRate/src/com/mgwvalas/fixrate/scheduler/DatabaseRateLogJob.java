package com.mgwvalas.fixrate.scheduler;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.fixrate.domain.FixRate;
import com.mgwvalas.fixrate.service.IFixRateService;
import com.mgwvalas.fixrate.service.IRateService;
import com.mgwvalas.fixrate.service.RatesBatchLogAppender;
import com.mgwvalas.moneychanger.domain.Rate;

public class DatabaseRateLogJob extends QuartzJobBean {
	
	protected Log log = LogFactory.getLog(getClass());
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		try {
			Map dataMap = context.getJobDetail().getJobDataMap();
			IFixRateService fixRateService = (IFixRateService) dataMap.get("fixRateService");
			IRateService rateService = (IRateService) dataMap.get("rateService");
			List<Rate> rates = new ArrayList<Rate>();
			
			if (fixRateService.isStale())
				return;
			
			Iterator<FixRate> fixRates = fixRateService.getRates().getRates().iterator();
			while (fixRates.hasNext()) {
				FixRate fixRate = (FixRate) fixRates.next();
				Rate rate = new Rate(fixRate.getCurrency(), fixRate.getBid(), fixRate.getAsk());
				if (!rate.isEmpty()) {
					rates.add(rate);
				}
			}
		
			rateService.save(rates);
			
			RatesBatchLogAppender ratesBatchLogAppender = (RatesBatchLogAppender) dataMap.get("ratesBatchLogAppender");
			ratesBatchLogAppender.updateIncomingRates(rates);
		} catch (Exception ex) {
			log.error(ex.getMessage(), ex);
		}
	}

}