package com.mgwvalas.fixrate.domain;

import org.junit.Assert;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.FixRate;


public class FixRateTest {
	
	@Test
	public void should_update_low_bid_when_fixrate_updated() {
		FixRate fx = new FixRate("IDR", 5, 5);
		fx.update(1d, 1d);
		Assert.assertEquals("Message", 1, fx.getLowBid(), 0);
	}
	
	@Test
	public void should_update_low_bid_when_updated_fixrate_is_lower() {
		FixRate fx = new FixRate("IDR", 5, 5);
		fx.update(6, 6);
		Assert.assertEquals("Message", 5, fx.getLowBid(), 0);
	}
	
	@Test
	public void should_update_high_bid_when_fixrate_updated() {
		FixRate fx = new FixRate("IDR", 5, 5);
		fx.update(1, 1);
		Assert.assertEquals("Message", 5, fx.getHighwBid(), 0);
	}
	
	@Test
	public void should_update_high_bid_when_updated_fixrate_is_lower() {
		FixRate fx = new FixRate("IDR", 5, 5);
		fx.update(6, 6);
		Assert.assertEquals("Message", 6, fx.getHighwBid(), 0);
	}
}
