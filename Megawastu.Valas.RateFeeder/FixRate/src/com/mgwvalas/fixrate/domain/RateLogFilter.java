package com.mgwvalas.fixrate.domain;

import java.util.List;

public class RateLogFilter {
	private List<RateLog> rateLogs;
	private List<RateLog> oldRateLogs;
	
	public RateLogFilter(List<RateLog> rateLogs, List<RateLog> oldRateLogs) {
		this.rateLogs = rateLogs;
		this.oldRateLogs = oldRateLogs;
	}

	public List<RateLog> getRateLogs() {
		return rateLogs;
	}

	public void setRateLogs(List<RateLog> rateLogs) {
		this.rateLogs = rateLogs;
	}

	public List<RateLog> getOldRateLogs() {
		return oldRateLogs;
	}

	public void setOldRateLogs(List<RateLog> oldRateLogs) {
		this.oldRateLogs = oldRateLogs;
	}
	
	
}
