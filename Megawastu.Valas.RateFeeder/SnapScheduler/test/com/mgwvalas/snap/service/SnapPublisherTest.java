package com.mgwvalas.snap.service;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "classpath:application-context.xml")
public class SnapPublisherTest {

	IMessagePublisher<Rates> snapUpdatedPublisher;
	Rates rates = new Rates();
	
	@Autowired
	public void setSnapUpdatedPublisher(IMessagePublisher<Rates> snapUpdatedPublisher) {
		this.snapUpdatedPublisher = snapUpdatedPublisher;
	}

	@Before
	public void setUp() {
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
		
		Rate idr = new Rate("IDR", 5, 5);
    	Rate aud = new Rate("MYR", 3, 2);
    	Rate yui = new Rate("YUI", 2, 7);
    	
    	rates.addRate(yui);
    	rates.addRate(aud);
    	rates.addRate(idr);
	}

	

	@Test
	public void should_publish_snap_message_to_topic() {
		snapUpdatedPublisher.publish(rates);
	}

}
