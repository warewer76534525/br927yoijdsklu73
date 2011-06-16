package com.mgwvalas.sintesis.handler;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.support.JmsUtils;
import org.springframework.stereotype.Component;

import com.mgwvalas.moneychanger.message.IStaleEvent;
import com.mgwvalas.sintesis.service.SintesisService;

@Component
public class StaleUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());

	@Autowired
	private SintesisService sintesisService;

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		IStaleEvent staleEvent;
		try {
			staleEvent = (IStaleEvent) mapMessage.getObject();
			
			log.info("Incoming Stale event: " + staleEvent.isStale());
			if (staleEvent.isStale()) {
				sintesisService.stale();
			} else {
				sintesisService.notStale();
			}
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
