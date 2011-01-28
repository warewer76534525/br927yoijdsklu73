package com.triplelands.megawastu.valas.moneychanger.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;

import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public class RatesUpdatedPublisher extends JmsGatewaySupport implements IMessagePublisher<Rates> {
	
	@Autowired
	public RatesUpdatedPublisher(@Qualifier("kursJmsTemplate")JmsTemplate jmsTemplate) {
		setJmsTemplate(jmsTemplate);
	}
	
	@Override
	public void publish(Rates rates) {
		getJmsTemplate().convertAndSend(rates);
	}

}
