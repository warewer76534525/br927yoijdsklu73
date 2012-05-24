package com.mgwvalas.fixrate.dao;

import java.util.List;

import com.mgwvalas.fixrate.domain.FixRate;

public interface ICurrencyDao {

	List<FixRate> queryCurrencyPairs();
	
}
