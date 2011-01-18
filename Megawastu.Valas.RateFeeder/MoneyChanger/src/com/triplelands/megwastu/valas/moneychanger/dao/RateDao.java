package com.triplelands.megwastu.valas.moneychanger.dao;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.sql.DataSource;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.simple.SimpleJdbcDaoSupport;
import org.springframework.stereotype.Repository;

import com.triplelands.megwastu.valas.moneychanger.domain.Rate;

@Repository("rateDao")
public class RateDao extends SimpleJdbcDaoSupport implements IRateDao {
	protected static Log log = LogFactory.getLog(RateDao.class);
	
	@Autowired()
	public RateDao(DataSource dataSource) {
		super.setDataSource(dataSource);
	}
	
	@Override
	public void save(List<Rate> rates) {
		List<Object[]> batch = new ArrayList<Object[]>();
	        for (Rate rate : rates) {
	            Object[] values = new Object[] {
	                    rate.getCurrency(),
	                    rate.getBid(),
	                    rate.getAsk(),
	                    new Date()};
	            batch.add(values);
	        }
	    int[] updateCounts = getSimpleJdbcTemplate().batchUpdate("INSERT INTO valas.rates (currency, bid, ask, TIMESTAMP) VALUES (?, ?, ?, ?)",  batch);
	    log.info("update batch: " + updateCounts);    
	}
	
	
	
	
}
