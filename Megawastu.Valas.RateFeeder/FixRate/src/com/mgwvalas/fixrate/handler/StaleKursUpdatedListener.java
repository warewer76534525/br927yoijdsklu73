package com.mgwvalas.fixrate.handler;

import javax.jms.Message;
import javax.jms.MessageListener;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.mgwvalas.fixrate.scheduler.StalenessTimeoutManager;

@Component
public class StaleKursUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());
	
	@Autowired
	private StalenessTimeoutManager stalenessTimeoutManager;
	
	@Override
	public void onMessage(Message message) {
		stalenessTimeoutManager.reset();
	}
}
