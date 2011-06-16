package com.mgwvalas.fixrate.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.fixrate.service.IFixRateService;
import com.mgwvalas.moneychanger.service.HolidayDateChecker;

public class HolidayCheckerJob extends QuartzJobBean {
	protected static Log log = LogFactory.getLog(HolidayCheckerJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		IFixRateService fixRateService = (IFixRateService) dataMap.get("fixRateService");
		String holidayList = (String)dataMap.get("holidayList");
		
		HolidayDateChecker holidayChecker = new HolidayDateChecker(holidayList);
		if (holidayChecker.isTodayHoliday()) {
			fixRateService.holyday();
		} else {
			fixRateService.notHolyday();
		}
		
		log.info("HolidayCheckerJob completed");
	}
	
	 

}