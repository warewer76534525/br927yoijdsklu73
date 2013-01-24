package com.mgwvalas.fixrate.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.fixrate.service.IFixRateService;

public class HolidayCheckerJob extends QuartzJobBean {
	protected Log log = LogFactory.getLog(getClass());
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		try {
			Map dataMap = context.getJobDetail().getJobDataMap();
			IFixRateService fixRateService = (IFixRateService) dataMap.get("fixRateService");
			
			fixRateService.reset();
		} catch (Exception ex) {
			log.error(ex.getMessage(), ex);
		}
	}

}
