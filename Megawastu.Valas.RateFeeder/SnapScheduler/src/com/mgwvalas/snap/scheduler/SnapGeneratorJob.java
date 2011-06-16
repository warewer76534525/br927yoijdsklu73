package com.mgwvalas.snap.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.snap.service.SnapService;

public class SnapGeneratorJob extends QuartzJobBean {
	protected static Log log = LogFactory.getLog(SnapGeneratorJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		SnapService snapService = (SnapService) dataMap.get("snapService");

		if (!snapService.isStale() && !snapService.isHoliday()) {
			snapService.publish();
		} else {
			//log.info("Snap Stale");
		}
	}

}
