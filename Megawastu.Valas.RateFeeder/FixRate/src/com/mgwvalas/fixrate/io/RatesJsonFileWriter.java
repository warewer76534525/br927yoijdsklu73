package com.mgwvalas.fixrate.io;

import java.io.File;
import java.util.List;

import com.fasterxml.jackson.core.JsonEncoding;
import com.fasterxml.jackson.core.JsonFactory;
import com.fasterxml.jackson.core.JsonGenerator;
import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.moneychanger.domain.Rate;

public class RatesJsonFileWriter {
	private String path;
	
	public RatesJsonFileWriter(String path) {
		this.path = path;
	}

	public void write(List<RateLog> rates) throws Exception {
		try {
			try {
				JsonFactory f = new JsonFactory();
				JsonGenerator g = f.createJsonGenerator(new File(path), JsonEncoding.UTF8);
				
				g.writeStartObject();
				g.writeFieldName("rates");
				g.writeStartArray();
				
				for (RateLog rate : rates) {
					g.writeStartObject();
					g.writeStringField("currency", rate.getCurrency());
					g.writeNumberField("bid", rate.getBid());
					g.writeNumberField("ask", rate.getAsk());
					g.writeNumberField("timestamp", rate.getTimeStamp().getTime());
					g.writeEndObject();
				}
				
				g.writeEndArray();
				g.writeEndObject();
				g.close(); // important: will force flushing of output, close underlying output stream
			} catch (Exception e) {
				e.printStackTrace();
			}
		} catch (Exception e) {
			throw e;
		}
	}
}
