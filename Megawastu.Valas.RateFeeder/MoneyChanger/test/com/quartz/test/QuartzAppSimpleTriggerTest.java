package com.quartz.test;

import org.quartz.SchedulerException;

public class QuartzAppSimpleTriggerTest {

	public static void main(String[] args) throws SchedulerException {
		new QuartzAppSimpleTrigger().run();
	}

}
