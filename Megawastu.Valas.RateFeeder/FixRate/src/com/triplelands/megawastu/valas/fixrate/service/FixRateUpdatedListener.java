package com.triplelands.megawastu.valas.fixrate.service;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.support.JmsUtils;
import org.springframework.stereotype.Component;

import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

@Component
public class FixRateUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());

	private IFixRateService fixRateService;
	
	@Autowired
	public void setFixRateService(IFixRateService fixRateService) {
		this.fixRateService = fixRateService;
	}

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		Rates rates;
		try {
			rates = (Rates) mapMessage.getObject();
			fixRateService.update(rates);
			fixRateService.serialize();
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
