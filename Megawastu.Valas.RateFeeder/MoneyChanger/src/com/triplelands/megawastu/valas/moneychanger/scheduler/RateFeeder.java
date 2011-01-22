package com.triplelands.megawastu.valas.moneychanger.scheduler;

import java.util.Date;
import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobDetail;
import org.quartz.Scheduler;
import org.quartz.SchedulerException;
import org.quartz.SimpleTrigger;
import org.quartz.impl.StdSchedulerFactory;

public class RateFeeder implements IRateFeeder {

	protected Log log = LogFactory.getLog(RateFeeder.class);

	private final static int MILLI_SECOND = 1000;
	private int interval = 2;
	private String directory;
	private String fileName;
	
	private boolean status = false;
	
	public RateFeeder() {

	}
	
	public RateFeeder(String directory, String fileName)
			throws SchedulerException {
		this.directory = directory;
		this.fileName = fileName;

		start();
	}

	public int getInterval() {
		return interval;
	}

	public void setInterval(int interval) {
		this.interval = interval;
	}

	public String getDirectory() {
		return directory;
	}

	public void setDirectory(String directory) {
		this.directory = directory;
	}

	public String getFileName() {
		return fileName;
	}

	public void setFileName(String fileName) {
		this.fileName = fileName;
	}

	@Override
	public void start() throws SchedulerException {
		RateGenerator rateGenerator = new RateGenerator(directory, fileName);

		// Spesify task schedule detail
		JobDetail jobDetail = new JobDetail();
		jobDetail.setName("rateFeederJob");
		jobDetail.setJobClass(RateFeederJob.class);

		@SuppressWarnings("unchecked")
		Map<String, Object> dataMap = jobDetail.getJobDataMap();
		dataMap.put("rateGenerator", rateGenerator);

		SimpleTrigger trigger = new SimpleTrigger();
		trigger.setName("rateFeederTrigger");
		trigger.setStartTime(new Date(System.currentTimeMillis() + MILLI_SECOND));
		trigger.setRepeatCount(SimpleTrigger.REPEAT_INDEFINITELY);
		trigger.setRepeatInterval(interval * MILLI_SECOND);

		// schedule it
		Scheduler scheduler = new StdSchedulerFactory().getScheduler();
		scheduler.scheduleJob(jobDetail, trigger);
		scheduler.start();
		
		status = true;
		log.info("rate feeder started");
	}

	@Override
	public boolean isStarted() {
		return status;
	}

}
