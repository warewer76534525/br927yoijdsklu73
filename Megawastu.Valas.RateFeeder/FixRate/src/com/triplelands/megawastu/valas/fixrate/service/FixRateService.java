package com.triplelands.megawastu.valas.fixrate.service;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Iterator;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;

import com.google.gson.Gson;
import com.triplelands.megawastu.valas.fixrate.domain.FixRate;
import com.triplelands.megawastu.valas.fixrate.domain.FixRates;
import com.triplelands.megawastu.valas.moneychanger.domain.Rate;
import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public class FixRateService implements IFixRateService {
	protected Log log = LogFactory.getLog(getClass());

	private FixRates fixRates = new FixRates();
	private String directory;
	private String fileName;

	public FixRates getRates() {
		return fixRates;
	}

	public void setRates(FixRates rates) {
		this.fixRates = rates;
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
			FixRate fixRate = new FixRate(rate);
			fixRates.update(fixRate);
		}
	}
	

	@Override
	public void serialize() {
		Gson gson = new Gson();
		String ratesJson = "";
		FileWriter fout = null;

		ratesJson = gson.toJson(fixRates);
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

	@Override
	public void reset() {
		log.info("Reset FixRate");
		fixRates.reset();
	}

}
