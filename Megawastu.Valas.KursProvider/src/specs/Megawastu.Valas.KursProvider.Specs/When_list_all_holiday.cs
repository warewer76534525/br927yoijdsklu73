using NUnit.Framework;
using System;
using Megawastu.Valas.KursProvider.Application;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_list_all_holiday
    {
        [Test]
        public void Should_register_holiday()
        {
            HolidayCalendar holidayCalendar = new HolidayCalendar();

            DateTime holiday = holidayCalendar.NextHoliday;

            Assert.AreEqual(25, holiday.Day);
            Assert.AreEqual(12, holiday.Month);
            Assert.AreEqual(2011, holiday.Year);
        }
    }
}
