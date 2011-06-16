package com.mgwvalas.moneychanger.domain;

public interface IMessagePublisher<T> {
	void publish(T t); 
}
