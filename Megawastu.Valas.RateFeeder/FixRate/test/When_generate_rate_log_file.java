import java.io.Console;
import java.util.Calendar;

import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;

import com.mgwvalas.fixrate.domain.RateLog;
import com.mgwvalas.moneychanger.domain.Rate;


public class When_generate_rate_log_file
{
	
	private RateLog _rate;
	
	@Before
	public void setUp() {
		Calendar rateDate = Calendar.getInstance();
		rateDate.add(Calendar.MONTH, -3);
		_rate = new RateLog();
		_rate.setId(1);
		_rate.setCurrency("EUR");
		_rate.setAsk(1.234);
		_rate.setBid(123123);
		_rate.setTimeStamp(rateDate.getTime());
	}
	
	@Test
	public void should_retrieve_log_six_month() {
		Calendar lastRateLog = Calendar.getInstance();
		lastRateLog.setTime(_rate.getTimeStamp());
		
		Calendar lastRangeSelectedDate = Calendar.getInstance();;
		lastRangeSelectedDate.add(Calendar.MONTH, -6);
		
		boolean lastRangeIsSmaller = lastRangeSelectedDate.compareTo(lastRateLog) < 0;
		
		Assert.assertTrue(lastRangeIsSmaller);
		if (lastRangeSelectedDate.compareTo(lastRateLog) < 0)
			System.out.println("Last range is smaller");
		else 
			System.out.println("Last range is greater");
		
		System.out.println(lastRangeSelectedDate.getTime());
	}
}
