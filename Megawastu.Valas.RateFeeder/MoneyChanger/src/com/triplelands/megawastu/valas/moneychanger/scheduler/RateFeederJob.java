package com.triplelands.megawastu.valas.moneychanger.scheduler;

import java.util.Map;

import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

public class RateFeederJob extends org.springframework.scheduling.quartz.QuartzJobBean {
	
	public RateFeederJob() {
		System.out.println("Install rate feeder job");
	}

	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		RateGenerator rateGenerator = (RateGenerator) dataMap.get("rateGenerator");
		
		
		rateGenerator.generate();
	} 

}
