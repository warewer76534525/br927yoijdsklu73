package com.mgwvalas.sintesis.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rates;
import com.mgwvalas.sintesis.service.SintesisService;

public class SintesisGeneratorJob extends QuartzJobBean {
	
	protected static Log log = LogFactory.getLog(SintesisGeneratorJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		try {
			Map dataMap = context.getJobDetail().getJobDataMap();
			SintesisService snapService = (SintesisService) dataMap.get("sintesisService");
			IMessagePublisher<Rates> sintesisUpdatedPublisher = (IMessagePublisher<Rates>) dataMap.get("sintesisUpdatedPublisher");
			
			if (!snapService.isStale() && !snapService.isHoliday()) {
				snapService.generateSintesis();
				
				Rates rates = snapService.GetSintesisRates();
				log.debug("begin publish snap rates"+ rates);
				sintesisUpdatedPublisher.publish(rates);
				log.debug("end publish snap rates"+ rates);
			} else {
				log.info("Sintesis Stale");
			}
		} catch (Exception e) {
			log.error(e.getMessage(), e);
		}
		
	}

}
