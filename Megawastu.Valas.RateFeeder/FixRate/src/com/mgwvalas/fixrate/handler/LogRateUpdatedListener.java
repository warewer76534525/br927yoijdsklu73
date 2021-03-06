package com.mgwvalas.fixrate.handler;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.MessageListener;
import javax.jms.ObjectMessage;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jms.support.JmsUtils;
import org.springframework.stereotype.Component;

import com.mgwvalas.fixrate.service.IRateService;
import com.mgwvalas.moneychanger.domain.Rates;

@Component
public class LogRateUpdatedListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());
	
	@Autowired
	private IRateService rateService;

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		Rates rates;
		try {
			rates = (Rates) mapMessage.getObject();
			
			rateService.save(rates.getRates());
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
