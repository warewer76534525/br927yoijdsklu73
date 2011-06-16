package com.mgwvalas.stale.scheduler;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.core.JmsTemplate;

import com.mgwvalas.moneychanger.message.NotStaleEvent;
import com.mgwvalas.moneychanger.message.StaleEvent;

public class StalenessTimeoutManager {
	protected static Log log = LogFactory.getLog(StalenessTimeoutManager.class);  
	private TimeoutManager timeoutManager;
	private boolean isStale = true;
	
	@Autowired
	private JmsTemplate staleJmsPublisher;
	
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
		log.info("on stale");
		if (!isStale) {
			publishStaleEvent();
			alreadyStale();
		}		
		restartCountDown();
	}

	private void restartCountDown() {
		log.info("restarted");
		timeoutManager.restart();
	}

	private void publishStaleEvent() {
		log.info("publish stale event");
		staleJmsPublisher.convertAndSend(new StaleEvent());
	}

	public void reset() {
		if (isStale) {
			notStaleAnymore();
			publishNotStaleAgainEvent();
		}
		
		restartCountDown();
	}

	private void publishNotStaleAgainEvent() {
		log.info("publish NON stale event");
		staleJmsPublisher.convertAndSend(new NotStaleEvent());
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
