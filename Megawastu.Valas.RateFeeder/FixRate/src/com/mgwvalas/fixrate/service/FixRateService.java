package com.mgwvalas.fixrate.service;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Iterator;
import java.util.List;

import javax.annotation.PostConstruct;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;

import com.google.gson.Gson;
import com.mgwvalas.fixrate.dao.ICurrencyDao;
import com.mgwvalas.fixrate.domain.FixRate;
import com.mgwvalas.fixrate.domain.FixRates;
import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;

public class FixRateService implements IFixRateService {
	protected Log log = LogFactory.getLog(getClass());

	private FixRates fixRates = new FixRates();
	private String directory;
	private String fileName;
	
	@Autowired
	private ICurrencyDao currencyDao;
	
	
	private boolean holidayWriteFlag = false;

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
	
	@PostConstruct
	public void init() {
		List<FixRate> availableRates = currencyDao.queryCurrencyPairs();
		log.info("INIT currencyListForSintesis: " + availableRates);
		
		fixRates.setRates(availableRates);
		fixRates.stale();
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
		
		log.debug("begin serialize fixrate update : " + fixRates.isHoliday() + ", write flag: " + holidayWriteFlag);
		
		if (fixRates.isHoliday() && holidayWriteFlag) {
			return;
		} else if (fixRates.isHoliday() && !holidayWriteFlag) {
			holidayWriteFlag = true;
		}
		
		ratesJson = gson.toJson(fixRates);
		try {
			fout = new FileWriter(new File(directory, fileName));
			log.debug("writedata" + ratesJson);
			fout.write(ratesJson);
		} catch (IOException e) {
			log.error(e.getMessage(), e);
		} finally {
			try {
				fout.close();
			} catch (Exception e) {
			}
		}
		log.debug("serialize fixrate, when holiday: " + fixRates.isHoliday() + ", write flag: " + holidayWriteFlag);
	}

	@Override
	public void reset() {
		log.info("Reset FixRate");
		fixRates.reset();
		notStale();
	}

	@Override
	public void stale() {
		fixRates.stale();
	}

	@Override
	public void notStale() {
		fixRates.notStale();
	}

	@Override
	public void holiday() {
		fixRates.holiday();
	}
	
	public boolean isStale() {
		return fixRates.isStale();
	}
	
	@Override
	public void notHoliday() {
		if (holidayWriteFlag) {
			holidayWriteFlag = false;
		}
		
		fixRates.notHoliday();
	}
	
	
}
