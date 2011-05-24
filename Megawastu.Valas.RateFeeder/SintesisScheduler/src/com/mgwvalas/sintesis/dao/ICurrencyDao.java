package com.mgwvalas.sintesis.dao;

import java.util.List;

public interface ICurrencyDao {

	List<String> findSnapCurrency();
	List<String> findSintesisCurrency();
	
}
