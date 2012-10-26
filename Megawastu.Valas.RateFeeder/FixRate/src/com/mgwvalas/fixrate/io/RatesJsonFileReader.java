package com.mgwvalas.fixrate.io;

import java.io.File;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import com.fasterxml.jackson.core.JsonFactory;
import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.core.JsonToken;
import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.moneychanger.domain.Rate;


public class RatesJsonFileReader {
	
	private String path;
	
	public RatesJsonFileReader(String path) {
		this.path = path;
	}

	public List<RateLog> readRates() {
		List<RateLog> rates = new ArrayList<RateLog>();
		try {
			JsonFactory f = new JsonFactory();
			JsonParser jp = f.createJsonParser(new File(path));
			RateLog rate = new RateLog();
			
			while (jp.nextToken() != JsonToken.END_OBJECT) {
				String fieldname = jp.getCurrentName();
				
				if ("rates".equals(fieldname)) {
					jp.nextToken();
					while (jp.nextToken() != JsonToken.END_ARRAY) {
						while (jp.nextToken() != JsonToken.END_OBJECT) {
							  fieldname = jp.getCurrentName();
							  jp.nextToken(); // move to value, or START_OBJECT/START_ARRAY
							  if ("currency".equals(fieldname)) { // contains an object
								  rate.setCurrency(jp.getText());
							  } else if ("bid".equals(fieldname)) {
								  rate.setBid(jp.getDoubleValue());
							  } else if ("ask".equals(fieldname)) {
								  rate.setAsk(jp.getDoubleValue());
							  } else if ("timestamp".equals(fieldname)) {
								  rate.setTimeStamp(new Date(jp.getLongValue()));
							  } else {
								  throw new IllegalStateException("Unrecognized field '"+fieldname+"'!");
							  }
							}
						rates.add(rate);
						rate = new RateLog();
					}
				}
			}
			
			jp.close(); // ensure resources get cleaned up timely and properly
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return rates;
	}
}
