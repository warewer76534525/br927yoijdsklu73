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

import com.mgwvalas.fixrate.service.FixRateService;
import com.mgwvalas.moneychanger.message.HolidayEvent;

@Component
public class HolidayListener implements MessageListener {
	protected Log log = LogFactory.getLog(getClass());

	@Autowired
	private FixRateService fixRateService;

	@Override
	public void onMessage(Message message) {
		ObjectMessage mapMessage = (ObjectMessage) message;
		HolidayEvent holidayEvent;
		try {
			holidayEvent = (HolidayEvent) mapMessage.getObject();
			
			log.info("Incoming Holiday event: " + holidayEvent.isHoliday());
			if (holidayEvent.isHoliday()) {
				fixRateService.holiday();
			} else {
				fixRateService.notHoliday();
			}
			fixRateService.serialize();
		} catch (JMSException e) {
			throw JmsUtils.convertJmsAccessException(e);
		}

	}
}
