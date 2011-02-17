package com.triplelands.megawastu.valas.fixrate.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;
import org.springframework.stereotype.Component;

import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.message.IStaleEvent;

@Component
public class StaleFixRatePublisher extends JmsGatewaySupport implements IMessagePublisher<IStaleEvent> {
	
	@Autowired
	public StaleFixRatePublisher(@Qualifier("staleJmsTemplate")JmsTemplate jmsTemplate) {
		setJmsTemplate(jmsTemplate);
	}
	
	@Override
	public void publish(IStaleEvent staleEvent) {
		getJmsTemplate().convertAndSend(staleEvent);
	}

}