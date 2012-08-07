package com.mgwvalas.fixrate.scheduler;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.fixrate.domain.FixRate;
import com.mgwvalas.fixrate.service.IFixRateService;
import com.mgwvalas.fixrate.service.IRateService;
import com.mgwvalas.moneychanger.domain.Rate;

public class DatabaseRateLogJob extends QuartzJobBean {
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		IFixRateService fixRateService = (IFixRateService) dataMap.get("fixRateService");
		IRateService rateService = (IRateService) dataMap.get("rateService");
		List<Rate> rates = new ArrayList<Rate>();
		
		for (FixRate fixrate : fixRateService.getRates().getRates()) {
			Rate rate = new Rate(fixrate.getCurrency(), fixrate.getBid(), fixrate.getAsk());
			rates.add(rate);
		}
		
		rateService.save(rates);
	}

}