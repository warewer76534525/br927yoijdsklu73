package com.triplelands.megawastu.valas.fixrate.scheduler;

import java.util.Map;

import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.triplelands.megawastu.valas.fixrate.service.IFixRateService;

public class EndOfDayJob extends QuartzJobBean {
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		IFixRateService fixRateService = (IFixRateService) dataMap.get("fixRateService");
		
		fixRateService.reset();
	}

}