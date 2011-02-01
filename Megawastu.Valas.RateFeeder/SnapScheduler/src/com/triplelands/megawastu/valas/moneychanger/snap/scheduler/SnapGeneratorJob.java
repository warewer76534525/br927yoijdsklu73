package com.triplelands.megawastu.valas.moneychanger.snap.scheduler;

import java.util.Map;

import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.triplelands.megawastu.valas.moneychanger.snap.service.SnapService;

public class SnapGeneratorJob extends QuartzJobBean {

	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		Map dataMap = context.getJobDetail().getJobDataMap();
		SnapService snapService = (SnapService) dataMap.get("snapService");

		snapService.publish();
	}

}
