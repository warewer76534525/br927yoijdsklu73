package com.triplelands.megawastu.valas.moneychanger.scheduler;

import java.util.Map;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

public class RateFeederJob implements Job {
	
	public RateFeederJob() {
		System.out.println("Install rate feeder job");
	}

	@SuppressWarnings("rawtypes")
	@Override
	public void execute(JobExecutionContext context) throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		RateGenerator rateGenerator = (RateGenerator) dataMap.get("rateGenerator");
		
		
		rateGenerator.generate();
	} 

}
