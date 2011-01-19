package com.triplelands.megwastu.valas.moneychanger.service;

import org.apache.log4j.BasicConfigurator;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.quartz.SchedulerException;

import com.triplelands.megawastu.valas.moneychanger.scheduler.IRateFeeder;
import com.triplelands.megawastu.valas.moneychanger.scheduler.RateFeeder;

public class RateFeederTester {
	
	
	public static void main(String[] args) throws SchedulerException {
		IRateFeeder rateFeeder;
		Logger.getRootLogger().setLevel(Level.INFO);
		Logger.getLogger("org.springframework").setLevel(Level.WARN);
		BasicConfigurator.configure();
		
		rateFeeder = new RateFeeder("C:\\temp\\tlands", "data.json");
		System.out.println(rateFeeder);
	}
}	
