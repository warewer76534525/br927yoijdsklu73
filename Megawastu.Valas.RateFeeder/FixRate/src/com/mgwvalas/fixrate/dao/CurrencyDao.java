package com.mgwvalas.fixrate.dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

import javax.sql.DataSource;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.jdbc.core.simple.SimpleJdbcDaoSupport;
import org.springframework.stereotype.Repository;

import com.mgwvalas.fixrate.domain.FixRate;

@Repository
public class CurrencyDao extends SimpleJdbcDaoSupport implements ICurrencyDao {
	protected final Log log = LogFactory.getLog(getClass());
	
	private final static String CURRENCY_QUERY = "SELECT c.name, c.type, c.fixed FROM currency c ORDER BY c.index ASC";
	
	@Autowired()
	public CurrencyDao(DataSource dataSource) {
		super.setDataSource(dataSource);
	}
	
	public List<FixRate> queryCurrencyPairs() {
		
		List<FixRate>  currencyList = getJdbcTemplate().query(CURRENCY_QUERY, new RateMapper());
		
		return currencyList;
	}
	
	private static class RateMapper implements RowMapper<FixRate> {

		public FixRate mapRow(ResultSet rs, int rowNum) throws SQLException {
			String currency = rs.getString("name");
			int fixed = rs.getInt("fixed");
			FixRate rate = new FixRate(currency, fixed);
			
			return rate;
		}
	}
}

