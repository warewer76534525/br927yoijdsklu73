package com.mgwvalas.sintesis.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.sintesis.service.SintesisService;

public class SintesisGeneratorJob extends QuartzJobBean {
	
	protected static Log log = LogFactory.getLog(SintesisGeneratorJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		SintesisService snapService = (SintesisService) dataMap.get("sintesisService");
		
		if (!snapService.isStale()) {
			snapService.generateSintesis();
			snapService.publish();
		} else {
			//log.info("Sintesis Stale");
		}
	}

}
