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

import com.mgwvalas.moneychanger.domain.Configuration;

@Repository
public class ConfigurationDao extends SimpleJdbcDaoSupport implements IConfigurationDao {
	protected final Log log = LogFactory.getLog(getClass());

	@Autowired()
	public ConfigurationDao(DataSource dataSource) {
		super.setDataSource(dataSource);
	}

	@Override
	public Configuration getHolidays() {
		String sql = "SELECT * FROM `configuration` WHERE `config_name` = 'HOLIDAYS_DATE'";
		List<Configuration> cofigs = getJdbcTemplate().query(sql, new ConfigMapper());
		
		return cofigs.get(0);
	}
	
	
	private static class ConfigMapper implements RowMapper<Configuration> {

		public Configuration mapRow(ResultSet rs, int rowNum) throws SQLException {
			Configuration config = new Configuration();
			config.setName(rs.getString("config_name"));
			config.setValue(rs.getString("config_value"));
			return config;
		}
	}
}
