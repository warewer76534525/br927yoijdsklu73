package com.triplelands.megawastu.valas.moneychanger.domain;

public interface IMessagePublisher<T> {
	void publish(T t); 
}
