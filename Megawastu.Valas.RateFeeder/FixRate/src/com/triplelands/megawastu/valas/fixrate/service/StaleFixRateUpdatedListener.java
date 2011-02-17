package com.triplelands.megawastu.valas.fixrate.service;

import javax.jms.Message;
import javax.jms.MessageListener;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.triplelands.megawastu.valas.fixrate.scheduler.StalenessTimeoutManager;

@Component
public class StaleFixRateUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());
	
	@Autowired
	private StalenessTimeoutManager stalenessTimeoutManager;
	
	@Override
	public void onMessage(Message message) {
		log.info("stale fixrate updated listener");
		stalenessTimeoutManager.reset();
	}
}