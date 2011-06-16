package com.mgwvalas.snap.service;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;
import org.springframework.stereotype.Service;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rates;

@Service
public class SnapUpdatedPublisher extends JmsGatewaySupport implements
		IMessagePublisher<Rates> {
	protected Log log = LogFactory.getLog(getClass());

	@Autowired
	public SnapUpdatedPublisher(
			@Qualifier("snapJmsTemplate") JmsTemplate jmsTemplate) {
		setJmsTemplate(jmsTemplate);
	}

	@Override
	public void publish(Rates rates) {
		getJmsTemplate().convertAndSend(rates);
	}

}
