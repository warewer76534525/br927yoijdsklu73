package com.triplelands.megawastu.valas.moneychanger.snap.service;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.triplelands.megawastu.valas.moneychanger.domain.IMessagePublisher;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = "classpath:application-context.xml")
public class SintesisPublisherTest {

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
		
		Rate idr = new Rate("IDR", 0, 0);
    	Rate aud = new Rate("MYR", 3, 2);
    	Rate yui = new Rate("YUI", 5, 6);
    	
    	rates.addRate(yui);
    	rates.addRate(aud);
    	rates.addRate(idr);
	}

	

	@Test
	public void should_publish_snap_message_to_topic() {
		snapUpdatedPublisher.publish(rates);
	}

}
