package com.mgwvalas.snap.scheduler;

import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.scheduling.quartz.QuartzJobBean;

import com.mgwvalas.moneychanger.domain.IMessagePublisher;
import com.mgwvalas.moneychanger.domain.Rates;
import com.mgwvalas.snap.service.SnapService;

public class SnapGeneratorJob extends QuartzJobBean {
	protected static Log log = LogFactory.getLog(SnapGeneratorJob.class);
	
	@SuppressWarnings("rawtypes")
	@Override
	protected void executeInternal(JobExecutionContext context)
			throws JobExecutionException {
		try {
			Map dataMap = context.getJobDetail().getJobDataMap();
			
			SnapService snapService = (SnapService) dataMap.get("snapService");
			IMessagePublisher<Rates> snapUpdatedPublisher = (IMessagePublisher<Rates>) dataMap.get("snapUpdatedPublisher");

			if (!snapService.isStale() && !snapService.isHoliday()) {
				Rates rates = snapService.getSnapRates();
				
				log.debug("begin publish snap rates"+ rates);
				snapUpdatedPublisher.publish(rates);
				log.debug("end publish snap rates"+ rates);
			} else {
				log.info("Snap Stale");
			}
		} catch (Exception e) {
			log.error(e.getMessage(), e);
		}
	}
	
	

}
