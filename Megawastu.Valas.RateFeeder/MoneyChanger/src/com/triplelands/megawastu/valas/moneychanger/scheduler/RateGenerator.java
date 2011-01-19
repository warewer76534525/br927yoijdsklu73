package com.triplelands.megawastu.valas.moneychanger.scheduler;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.google.gson.Gson;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;
import com.triplelands.util.RandomNumber;

public class RateGenerator {
	protected Log log = LogFactory.getLog(RateGenerator.class);
	private String fileName;
	private String directory;
	
	public RateGenerator(String directory, String fileName) {
		this.directory = directory;
		this.fileName = fileName;
	}
	
	public void generate() {
		log.info("publish data to json");
		Gson gson = new Gson();
		String ratesJson = "";
		FileWriter fout = null;
		
		RandomNumber random = RandomNumber.getInstance();
		
		Rates rates = new Rates();
		Rate idr = new Rate("IDR", Long.parseLong(random.random(5)), Long.parseLong(random.random(5)));
		Rate eur = new Rate("EUR", Long.parseLong(random.random(5)), Long.parseLong(random.random(5)));
		Rate sgd = new Rate("SGD", Long.parseLong(random.random(5)), Long.parseLong(random.random(5)));
		
		rates.addRate(idr);
		rates.addRate(eur);
		rates.addRate(sgd);
		
		ratesJson = gson.toJson(rates);
		try {
			fout = new FileWriter(new File(directory, fileName));
			fout.write(ratesJson);
		} catch (IOException e) {
			log.error(e.getMessage(), e);
		} finally {
			try {
				fout.close();
			} catch (Exception e) {}
		}
	}

}
