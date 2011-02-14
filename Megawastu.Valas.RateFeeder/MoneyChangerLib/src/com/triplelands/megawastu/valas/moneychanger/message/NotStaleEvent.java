package com.triplelands.megawastu.valas.moneychanger.message;

import java.io.Serializable;


@SuppressWarnings("serial")
public class NotStaleEvent implements IStaleEvent, Serializable {
	private boolean _stale;
	
	public NotStaleEvent() {
		_stale = false;
	}
	
	@Override
	public boolean isStale() {
		return _stale;
	}

}
