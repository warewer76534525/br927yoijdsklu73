package com.mgwvalas.stale.handler;

import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.mgwvalas.stale.scheduler.StalenessTimeoutManager;

@Component
public class StaleKursUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());
	
	@Autowired
	private StalenessTimeoutManager stalenessTimeoutManager;

	@Override
	public void onMessage(Message message) {
		try {
			log.info("Not stale anymore");
			stalenessTimeoutManager.reset();
		} catch (Exception e) {
			log.error(e.getMessage(), e);
		}
	}
	
}


