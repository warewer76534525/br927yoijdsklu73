package com.mgwvalas.moneychanger.service;

import static org.junit.Assert.*;

import java.lang.reflect.Type;
import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.Date;
import java.util.Locale;

import org.junit.Test;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonElement;
import com.google.gson.JsonPrimitive;
import com.google.gson.JsonSerializationContext;
import com.google.gson.JsonSerializer;
import com.mgwvalas.moneychanger.domain.Rate;

public class GsonFormaterTest {

	@Test
	public void test() {
		JsonSerializer<Double> ser = new JsonSerializer<Double>() {
				public JsonElement serialize(Double src, Type typeOfSrc, JsonSerializationContext 
			             context) {
					return src == null ? null : new JsonPrimitive(src.toString());
	
				}
				
			};
			
		Rate rate = new Rate();
		rate.setCurrency("IDR");
		rate.setBid(12093.6672);
		rate.setAsk(12022.6676);
		
		System.out.println(rate);
		Gson gson = new Gson();
		
		
		NumberFormat n = new DecimalFormat("#,###.0000");

		double doublePayment = 120232393.66;
		String s = n.format(doublePayment);
		System.out.println(s);

		System.out.println(gson.toJson(rate));
	}

}
