package com.mgwvalas.moneychanger.service;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.context.annotation.Scope;
import org.springframework.context.annotation.ScopedProxyMode;
import org.springframework.jms.core.JmsTemplate;
import org.springframework.jms.core.support.JmsGatewaySupport;
import org.springframework.stereotype.Component;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rates;

@Component
@Scope(proxyMode=ScopedProxyMode.INTERFACES, value="request")
public class RatesUpdatedPublisher extends JmsGatewaySupport implements IMessagePublisher<Rates> {
	
	protected Log log = LogFactory.getLog(RatesUpdatedPublisher.class);
	
	@Autowired
	public RatesUpdatedPublisher(@Qualifier("kursJmsTemplate")JmsTemplate jmsTemplate) {
		setJmsTemplate(jmsTemplate);
		log.info("Instansiate new publisher");
	}
	
	@Override
	public void publish(Rates rates) {
		log.debug("Begin publish");
		getJmsTemplate().convertAndSend(rates);
		log.debug("Begin end publish");
	}

}
