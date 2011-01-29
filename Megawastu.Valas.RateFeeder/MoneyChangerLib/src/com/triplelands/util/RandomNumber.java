package com.triplelands.util;

import java.util.Random;

public class RandomNumber {
	private static Random random = new Random();

	private static RandomNumber instance = new RandomNumber();

	private RandomNumber() {

	}

	public static RandomNumber getInstance() {
		return instance;
	}

	public String random(int length) {
		String code = new String("");
		for (int i = 0; i < length; i++) {
			code += (char) (random.nextInt(10) + '0');
		}
		return code;
	}

}
