package com.triplelands.megawastu.valas.moneychanger.sintesis.service;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;
import org.springframework.stereotype.Service;

import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

@Service
public class SintesisUpdatedPublisher extends JmsGatewaySupport implements IMessagePublisher<Rates> {
	protected Log log = LogFactory.getLog(getClass());
	
	@Autowired
	public SintesisUpdatedPublisher(@Qualifier("sintesisJmsTemplate")JmsTemplate jmsTemplate) {
		setJmsTemplate(jmsTemplate);
	}
	
	@Override
	public void publish(Rates rates) {
		getJmsTemplate().convertAndSend(rates);
	}

}
