package com.triplelands.megawastu.valas.moneychanger.snap.service;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.support.JmsUtils;
import org.springframework.stereotype.Component;

import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

@Component
public class RateUpdatedListener implements MessageListener {
	private SnapService snapService;

	@Autowired
	public void setSnapService(SnapService snapService) {
		this.snapService = snapService;
	}

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		Rates rates;
		try {
			rates = (Rates) mapMessage.getObject();
			snapService.update(rates);
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
