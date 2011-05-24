package com.mgwvalas.moneychanger.message;

import java.io.Serializable;


@SuppressWarnings("serial")
public class StaleEvent implements IStaleEvent, Serializable {
	private boolean _stale;
	
	public StaleEvent() {
		_stale = true;
	}
	
	@Override
	public boolean isStale() {
		return _stale;
	}

}
