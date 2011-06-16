package com.mgwvalas.sintesis.domain;

import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

import org.springframework.stereotype.Repository;

import com.mgwvalas.moneychanger.domain.Rate;
import com.mgwvalas.moneychanger.domain.Rates;

@Repository
public class CurrencySintzRepository {
	private Map<String, CurrencySintz> currencyMaps = new LinkedHashMap<String, CurrencySintz>();
	
	public Rates sitesisResults() {
		List<Rate> rates = new ArrayList<Rate>();
		
		for (CurrencySintz sintz : currencyMaps.values()) {
			rates.add(sintz.current());
		}
		
		return new Rates(rates);
	}

	public CurrencySintz findByCurrency(String currency) {
		
		if (!currencyMaps.containsKey(currency)) 
			currencyMaps.put(currency, new CurrencySintz(currency));
		
		return currencyMaps.get(currency);
	}

}
