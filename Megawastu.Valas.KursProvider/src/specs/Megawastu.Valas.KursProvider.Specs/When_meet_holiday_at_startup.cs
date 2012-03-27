using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;
using NUnit.Framework;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    class When_meet_holiday_at_startup
    {
        private HolidayPauseTimer _holidayPauseTimer;

        [SetUp]
        public void SetUp()
        {
            _holidayPauseTimer = new HolidayPauseTimer();
            _holidayPauseTimer.OnHolidayStart += holidayPauseTimer_OnHolidayStart;
            _holidayPauseTimer.OnHolidayEnd += holidayPauseTimer_OnHolidayEnd;
        }

        private void holidayPauseTimer_OnHolidayEnd()
        {
            Console.WriteLine("Holiday End, Start the Publisher");
        }

        private void holidayPauseTimer_OnHolidayStart()
        {
            Console.WriteLine("Holiday Begin, Stop the publisher");
        }

        [Test]
        public void Should_pause_the_kurs_provider()
        {
            _holidayPauseTimer.Start();
            Thread.Sleep(5 * 1000);
        }
    }
}
