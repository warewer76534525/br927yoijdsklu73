package com.triplelands.megawastu.valas.moneychanger.scheduler;

import org.quartz.SchedulerException;

public interface IRateFeeder {
	public void start() throws SchedulerException;
	public boolean isStarted();
}
