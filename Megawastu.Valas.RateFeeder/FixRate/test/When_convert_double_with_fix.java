import org.junit.Assert;
import org.junit.Test;


public class When_convert_double_with_fix {
	
	@Test
	public void should_include_zero_value() {
		String number = "1.3630";
		int fixed = 4;
		
		double converted = Double.parseDouble(number);
		Assert.assertEquals("message", number, "" + converted);
	}
}
