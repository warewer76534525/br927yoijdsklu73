package com.mgwvalas.sintesis.scheduler;

import java.util.Map;

import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.sintesis.service.SintesisService;

public class SintesisGeneratorJob extends QuartzJobBean {
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		SintesisService snapService = (SintesisService) dataMap.get("sintesisService");
		
		snapService.generateSintesis();
		snapService.publish();  
	}

}
