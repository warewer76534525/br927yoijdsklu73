package com.triplelands.megawastu.valas.moneychanger.dao;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import javax.sql.DataSource;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.jdbc.core.simple.SimpleJdbcDaoSupport;
import org.springframework.stereotype.Repository;

import com.triplelands.megawastu.valas.moneychanger.domain.Currency;

@Repository
public class CurrencyDao extends SimpleJdbcDaoSupport implements ICurrencyDao {
	protected final Log log = LogFactory.getLog(getClass());
	private final static String SNAP_TYPE = "SNAP";
	private final static String SINTESIS_TYPE = "SINTESIS";
	
	private final static String CURRENCY_QUERY = "SELECT c.name, c.type FROM currency c WHERE c.type=?";
	
	@Autowired()
	public CurrencyDao(DataSource dataSource) {
		super.setDataSource(dataSource);
	}
	
	@Override
	public List<String> findSnapCurrency() {
		return queryCurrency(SNAP_TYPE);
	}
	
	@Override
	public List<String> findSintesisCurrency() {
		return queryCurrency(SINTESIS_TYPE);
	}

	private List<String> queryCurrency(String type) {
		List<String> currencyNameList = new ArrayList<String>();
		List<Currency>  currencyList = getJdbcTemplate().query(CURRENCY_QUERY,  new Object[]{type}, new CurrencyMapper());
		for (Currency currency : currencyList) {
			currencyNameList.add(currency.getName());
		}
		return currencyNameList;
	}
	
	private static class CurrencyMapper implements RowMapper<Currency> {

		public Currency mapRow(ResultSet rs, int rowNum) throws SQLException {
			Currency currency = new Currency();
			currency.setName(rs.getString("name"));
			currency.setType(rs.getString("type"));
			return currency;
		}
	}
}

