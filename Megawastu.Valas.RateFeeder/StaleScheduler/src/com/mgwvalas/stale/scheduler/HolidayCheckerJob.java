package com.mgwvalas.stale.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.moneychanger.message.HolidayEvent;
import com.mgwvalas.stale.service.HolidayDateChecker;

public class HolidayCheckerJob extends QuartzJobBean {
	protected static Log log = LogFactory.getLog(HolidayCheckerJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		HolidayEvent event = null;
		Map dataMap = context.getJobDetail().getJobDataMap();
		JmsTemplate holidayJmsPublisher = (JmsTemplate) dataMap.get("holidayJmsPublisher");
		String holidayList = (String)dataMap.get("holidayList");
		
		HolidayDateChecker holidayChecker = new HolidayDateChecker(holidayList);
		if (holidayChecker.isTodayHoliday()) {
			event = new HolidayEvent(true);
		} else {
			event = new HolidayEvent(false);
		}
		
		holidayJmsPublisher.convertAndSend(event);
	}
	
	 

}