package com.triplelands.megawastu.valas.moneychanger.service;

import com.triplelands.megawastu.valas.moneychanger.domain.Rates;

public interface IRatesUpdatedPublisher {
	void publish(Rates rates);
}
