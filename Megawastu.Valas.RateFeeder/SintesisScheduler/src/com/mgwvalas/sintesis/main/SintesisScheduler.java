package com.mgwvalas.sintesis.main;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;

import org.boris.winrun4j.AbstractService;
import org.boris.winrun4j.EventLog;
import org.boris.winrun4j.ServiceException;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class SintesisScheduler extends AbstractService {
	private ClassPathXmlApplicationContext context;
	
	public int serviceRequest(int control) throws ServiceException {
		switch (control) {
		case SERVICE_CONTROL_STOP:
		case SERVICE_CONTROL_SHUTDOWN:
			context.stop();
			context.close();
			shutdown = true;
			break;
		default:
			break;
		}
		return 0;
	}

	@Override
	public int serviceMain(String[] arg0) throws ServiceException {
		try {
			context = new ClassPathXmlApplicationContext(
					"application-context.xml");
		} catch (Exception e) {
			EventLog.report("Fix Rate Service", EventLog.ERROR,
					e.getMessage());
			PrintWriter writer;
			try {
				writer = new PrintWriter(new File("D:/fixrate.log"));
				writer.println(e.getMessage());
				writer.close();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		}
		return 0;
	}
}
