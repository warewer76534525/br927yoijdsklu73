package com.triplelands.megawastu.valas.moneychanger.domain;

import java.io.Serializable;

import javax.jms.JMSException;
import javax.jms.Message;
import javax.jms.ObjectMessage;
import javax.jms.Session;

import org.springframework.jms.support.converter.MessageConversionException;
import org.springframework.jms.support.converter.MessageConverter;
import org.springframework.stereotype.Component;
@Component
public class SerializableMessageConverter implements MessageConverter {

	@Override
	public Object fromMessage(Message message) throws JMSException,
			MessageConversionException {
		ObjectMessage mapMessage = (ObjectMessage) message;
		return mapMessage.getObject();
	}

	@Override
	public Message toMessage(Object object, Session session)
			throws JMSException, MessageConversionException {
		Message message = null;
		Serializable serializable = (Serializable) object;
		message = session.createObjectMessage(serializable);
		
		return message;
	}

}
