package com.quartz.test;

import java.util.Map;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

public class RunMeJob implements Job {
	public void execute(JobExecutionContext context)
			throws JobExecutionException {

		Map dataMap = context.getJobDetail().getJobDataMap();
		RunMeTask task = (RunMeTask) dataMap.get("runMeTask");
		task.printMe();
	}

}
