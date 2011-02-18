package com.triplelands.megawastu.valas.fixrate.scheduler;

import java.util.Timer;
import java.util.TimerTask;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

public class TimeoutManager {
	protected static Log log = LogFactory.getLog(TimeoutManager.class);  
	private Timer currentTimeoutTimer;
	private long timeout;
	private TimeoutHandler timeoutHandler;
	
	public TimeoutManager(long timeout) {
		this.timeout = timeout;
	}

	public void setTimeoutHandler(TimeoutHandler timeoutHandler) {
		this.timeoutHandler = timeoutHandler;
	}
	
	public void start() {
		currentTimeoutTimer = createTimeoutTimer();
	}
	
	public void shutdown() {
		currentTimeoutTimer.cancel();
	}
	
	private Timer createTimeoutTimer() {
		Timer tmr = new Timer(false);
		
		tmr.schedule(new TimerTask() {
			@Override
			public void run() {
				onTimeout();
			}
		}, timeout, timeout);
		
		return tmr;
	}

	private void onTimeout() {
		timeoutHandler.onTimeout();	
	}

	public void restart() {
		log.info("restart");
		currentTimeoutTimer.cancel();
		start();
	}
}
