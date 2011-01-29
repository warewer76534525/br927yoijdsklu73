package com.triplelands.megawastu.valas.fixrate.service;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Iterator;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.google.gson.Gson;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public class FixRateService implements IFixRateService {
	protected Log log = LogFactory.getLog(getClass());

	private Rates rates = new Rates();
	private String directory;
	private String fileName;

	public Rates getRates() {
		return rates;
	}

	public void setRates(Rates rates) {
		this.rates = rates;
	}

	public void setDirectory(String directory) {
		this.directory = directory;
	}

	public void setFileName(String fileName) {
		this.fileName = fileName;
	}

	public void update(Rates _rate) {
		Iterator<Rate> ratesIterator = _rate.getRates().iterator();
		while (ratesIterator.hasNext()) {
			Rate rate = (Rate) ratesIterator.next();
			rates.update(rate);
		}
	}

	@Override
	public void serialize() {
		Gson gson = new Gson();
		String ratesJson = "";
		FileWriter fout = null;

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
		log.info("serialize: " + ratesJson);
	}

}
