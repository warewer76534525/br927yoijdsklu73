package com.mgwvalas.archiver;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.fixrate.domain.RateLogFilter;
import com.mgwvalas.fixrate.io.RatesJsonFileReader;
import com.mgwvalas.fixrate.io.RatesJsonFileWriter;

public class RateLogsArchiver {
	
	private String baseDir;
	private String currency;
	
	public RateLogsArchiver(String baseDir, String currency) {
		this.baseDir = baseDir;
		this.currency = currency;
	}
	
	public void Archived(int archiveLimit) throws Exception {
		RateLogArchiverFilter archiverFilter = new RateLogArchiverFilter(archiveLimit);
		
		File srcJson = new File(baseDir, currency + ".json");
		RatesJsonFileReader reader = new RatesJsonFileReader(srcJson.getAbsolutePath());
		
		List<RateLog> rates = reader.readRates();
		RateLogFilter filteredRate = archiverFilter.filter(rates);
		
		WriteNewRates(srcJson, filteredRate); 
		
		if (filteredRate.getOldRateLogs().size() > 0) {
			ArchivedOldRates(srcJson, filteredRate);
		}
	}

	private void ArchivedOldRates(File srcJson,
			RateLogFilter filteredRate) throws Exception {
		File arcvdFile = new File(baseDir, currency + ".arcvd");
		List<RateLog> arcvdRates = new ArrayList<RateLog>();
		
		if(arcvdFile.exists()) {
			RatesJsonFileReader arcvdReader = new RatesJsonFileReader(srcJson.getAbsolutePath());
			List<RateLog> oldArcvd = arcvdReader.readRates();
			arcvdRates.addAll(oldArcvd);
		}
		arcvdRates.addAll(filteredRate.getOldRateLogs());
		
		RatesJsonFileWriter writer = new RatesJsonFileWriter(arcvdFile.getAbsolutePath());
		writer.write(arcvdRates);
	}

	private void WriteNewRates(File srcJson, RateLogFilter filteredRate)
			throws Exception {
		if (filteredRate.getRateLogs().size() > 0) {
			RatesJsonFileWriter writer = new RatesJsonFileWriter(srcJson.getAbsolutePath());
			writer.write(filteredRate.getRateLogs());
		}
	}
}
