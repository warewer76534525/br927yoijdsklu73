package com.triplelands.megawastu.valas.moneychanger.scheduler;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.List;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.google.gson.Gson;
import com.triplelands.megawastu.valas.moneychanger.dao.IRateDao;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;
import com.triplelands.util.RandomNumber;

public class RateGenerator {
	protected Log log = LogFactory.getLog(RateGenerator.class);

	private String fileName;
	private String directory;
	private IRateDao rateDao;

	public RateGenerator(String directory, String fileName) {
		this.directory = directory;
		this.fileName = fileName;
	}

	public void setRateDao(IRateDao rateDao) {
		this.rateDao = rateDao;
	}

	public RateGenerator() {

	}

	public void setFileName(String fileName) {
		this.fileName = fileName;
	}

	public void setDirectory(String directory) {
		this.directory = directory;
	}

	public void generate() {
		log.info("publish data to json");
		Gson gson = new Gson();
		String ratesJson = "";
		FileWriter fout = null;

		RandomNumber random = RandomNumber.getInstance();

		Rates rates = new Rates();
		List<Rate> rateList = rateDao.findLatestRates();
		for (Rate rate : rateList) {
			rate.setAsk(Double.parseDouble(random.random(5)));
			rate.setBid(Double.parseDouble(random.random(5)));
			rates.addRate(rate);
		}
		
		ratesJson = gson.toJson(rates);
		try {
			fout = new FileWriter(new File(directory, fileName));
			fout.write(ratesJson);
		} catch (IOException e) {
			log.error(e.getMessage(), e);
		} finally {
			try {
				fout.close();
			} catch (Exception e) {
			}
		}
	}

}
