package com.triplelands.megawastu.valas.moneychanger.dao;

import java.util.List;

public interface ICurrencyDao {

	List<String> findSnapCurrency();
	List<String> findSintesisCurrency();
	
}
