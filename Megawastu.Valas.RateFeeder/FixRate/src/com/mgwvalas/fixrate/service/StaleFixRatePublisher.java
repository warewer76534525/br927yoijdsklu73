package com.mgwvalas.fixrate.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;
import org.springframework.stereotype.Component;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.message.IStaleEvent;

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