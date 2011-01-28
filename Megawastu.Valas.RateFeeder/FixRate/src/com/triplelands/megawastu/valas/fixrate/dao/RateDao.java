package com.triplelands.megawastu.valas.fixrate.dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.sql.DataSource;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.jdbc.core.simple.SimpleJdbcDaoSupport;
import org.springframework.stereotype.Repository;

import com.triplelands.megawastu.valas.moneychanger.domain.Rate;

@Repository("rateDao")
public class RateDao extends SimpleJdbcDaoSupport implements IRateDao {
	protected final Log log = LogFactory.getLog(getClass());
	
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
	    getSimpleJdbcTemplate().batchUpdate("INSERT INTO rates_log (currency, bid, ask, TIMESTAMP) VALUES (?, ?, ?, ?)",  batch);    
	}

	@Override
	public List<Rate> findLatestRates() {
		String sql = "SELECT * FROM rates r GROUP BY r.currency ORDER BY r.currency ASC, r.timestamp DESC ";
		return getJdbcTemplate().query(sql, new RateMapper());
	}
	
	private static class RateMapper implements
	RowMapper<Rate> {

		public Rate mapRow(ResultSet rs, int rowNum)
				throws SQLException {
			Rate rate = new Rate();
			rate.setCurrency(rs.getString("CURRENCY"));
			rate.setBid(rs.getDouble("BID"));
			rate.setAsk(rs.getInt("ASK"));
			
			return rate;
		}
	}
	
	
	
}
