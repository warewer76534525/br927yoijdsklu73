package com.mgwvalas.fixrate.scheduler;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;

import com.mgwvalas.fixrate.service.StaleFixRatePublisher;
import com.mgwvalas.moneychanger.message.NotStaleEvent;
import com.mgwvalas.moneychanger.message.StaleEvent;

public class StalenessTimeoutManager {
	protected static Log log = LogFactory.getLog(StalenessTimeoutManager.class);  
	private TimeoutManager timeoutManager;
	private boolean isStale = true;
	
	@Autowired
	private StaleFixRatePublisher staleFixRatePublisher;
	
	public StalenessTimeoutManager(long staleInterval) {
		
		timeoutManager = new TimeoutManager(staleInterval);
		timeoutManager.setTimeoutHandler(new TimeoutHandler() {

			@Override
			public void onTimeout() {
				onStalenessReached();
			}
		});
	}

	private void onStalenessReached() {
		if (!isStale) {
			publishStaleEvent();
			alreadyStale();
		}		
		restartCountDown();
	}

	private void restartCountDown() {
		timeoutManager.restart();
	}

	private void publishStaleEvent() {
		staleFixRatePublisher.publish(new StaleEvent());
	}

	public void reset() {
		if (isStale) {
			notStaleAnymore();
			publishNotStaleAgainEvent();
		}
		
		restartCountDown();
	}

	private void publishNotStaleAgainEvent() {
		staleFixRatePublisher.publish(new NotStaleEvent());
	}

	private void notStaleAnymore() {
		isStale = false;
	}

	private void alreadyStale() {
		isStale = true;
	}

	public void start() {
		timeoutManager.start();
	}
	
	public void shutdown() {
		timeoutManager.shutdown();
	}
}
