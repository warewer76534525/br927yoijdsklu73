package com.mgwvalas.sintesis.service;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.support.JmsUtils;
import org.springframework.stereotype.Component;

import com.mgwvalas.moneychanger.domain.Rates;

@Component
public class RateUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());
	private SintesisService snapService;

	@Autowired
	public void setSnapService(SintesisService snapService) {
		this.snapService = snapService;
	}

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		Rates rates;
		try {
			rates = (Rates) mapMessage.getObject();
			log.info("incoming updated rates: " + rates);
			snapService.update(rates);
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
