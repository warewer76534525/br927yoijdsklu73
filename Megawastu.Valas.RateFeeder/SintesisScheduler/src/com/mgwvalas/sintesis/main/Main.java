package com.mgwvalas.sintesis.main;

import org.springframework.context.support.ClassPathXmlApplicationContext;

public class Main {

	public static void main(String[] args) {
		new ClassPathXmlApplicationContext("application-context.xml");
	}

}
