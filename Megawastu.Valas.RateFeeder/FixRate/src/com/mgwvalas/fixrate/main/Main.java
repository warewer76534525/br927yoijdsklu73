package com.mgwvalas.fixrate.main;

import java.util.TimeZone;

import org.springframework.context.support.ClassPathXmlApplicationContext;

public class Main {

	public static void main(String[] args) {
		TimeZone.setDefault(TimeZone.getTimeZone("Etc/UTC"));
		new ClassPathXmlApplicationContext("application-context.xml");
	}
}
