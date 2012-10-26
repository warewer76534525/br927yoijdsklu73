package com.mgwvalas.fixrate.io;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.PrintStream;
import java.util.List;

import com.mgwvalas.fixrate.domain.RateLog;

public class RatesStockChartFileWriter {
	
	private String stockChartBase;
	private String bidPath;
	private String askPath;
	
	public RatesStockChartFileWriter(String path, String currency) {
		this.stockChartBase = path;
		String bidName = currency.toUpperCase() + "BID.data";
		String askName = currency.toUpperCase() + "ASK.DATA";
		File bidFile = new File(stockChartBase, bidName);
		File askFile = new File(stockChartBase,askName);
		
		bidPath = bidFile.getAbsolutePath();
		askPath = askFile.getAbsolutePath();
	}
	
	public void write(List<RateLog> rates) throws IOException {
		PrintStream bidStream = new PrintStream(new FileOutputStream(bidPath));
		PrintStream askStream = new PrintStream(new FileOutputStream(askPath));
		
		int counter = 1;
		bidStream.print('[');
		askStream.print('[');
		
		for (RateLog rateLog : rates) {
			bidStream.print('[');
			bidStream.print(rateLog.getTimeStamp().getTime());
			bidStream.print(',');
			bidStream.print(rateLog.getBid());
			bidStream.print(']');
			
			askStream.print('[');
			askStream.print(rateLog.getTimeStamp().getTime());
			askStream.print(',');
			askStream.print(rateLog.getAsk());
			askStream.print(']');
			
			if (counter != rates.size()) {
				bidStream.print(',');
				askStream.print(',');
			}
			counter++;
		}
		bidStream.print(']');
		bidStream.close();
		
		askStream.print(']');
		askStream.close();
	}
	
}
