package com.quartz.test;

import java.util.Date;
import java.util.Map;

import org.quartz.JobDetail;
import org.quartz.Scheduler;
import org.quartz.SchedulerException;
import org.quartz.SimpleTrigger;
import org.quartz.impl.StdSchedulerFactory;

public class QuartzAppSimpleTrigger {
	public void run() throws SchedulerException {
		RunMeTask task = new RunMeTask();
		 
    	//specify your sceduler task details
    	JobDetail job = new JobDetail();
    	job.setName("runMeJob");
    	job.setJobClass(RunMeJob.class);
 
    	Map dataMap = job.getJobDataMap();
    	dataMap.put("runMeTask", task);
 
    	//configure the scheduler time
    	SimpleTrigger trigger = new SimpleTrigger();
    	trigger.setName("runMeJobTesting");
    	trigger.setStartTime(new Date(System.currentTimeMillis() + 1000));
    	trigger.setRepeatCount(SimpleTrigger.REPEAT_INDEFINITELY);
    	trigger.setRepeatInterval(1000);
 
    	//schedule it
    	Scheduler scheduler = new StdSchedulerFactory().getScheduler();
    	scheduler.start();
    	scheduler.scheduleJob(job, trigger);

	}
}
