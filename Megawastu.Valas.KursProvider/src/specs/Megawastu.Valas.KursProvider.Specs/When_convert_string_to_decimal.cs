using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using NUnit.Framework;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    class When_convert_string_to_decimal
    {
        [Test]
        public void Should_include_the_zero_value()
        {
            var number = "1.3630";
            var converted = double.Parse(Convert.ToDouble(number).ToString("####0.0000"));
            Console.WriteLine(converted);
        }

    }
}
