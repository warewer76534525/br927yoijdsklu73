package com.mgwvalas.fixrate.main;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.boris.winrun4j.AbstractService;
import org.boris.winrun4j.ServiceException;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class FixRateService extends AbstractService {
	private ClassPathXmlApplicationContext context;
	protected Log log = LogFactory.getLog(getClass());
	
	public int serviceRequest(int control) throws ServiceException {
		switch (control) {
		case SERVICE_CONTROL_STOP:
		case SERVICE_CONTROL_SHUTDOWN:
			try {
				log.info("BEGIN shutdown fixrate service");
				context.close();
				log.info("END shutdown fixrate service");
			} catch (Exception e) {
				log.error(e.getMessage(), e);
			} finally {
				shutdown = true;
			}
			break;
		default:
			break;
		}
		return 0;
	}

	@Override
	public int serviceMain(String[] arg0) throws ServiceException {
		try {
			context = new ClassPathXmlApplicationContext("application-context.xml");
			context.registerShutdownHook();
		} catch (Exception e) {
			log.error(e.getMessage(), e);
		}
		return 0;
	}
}
