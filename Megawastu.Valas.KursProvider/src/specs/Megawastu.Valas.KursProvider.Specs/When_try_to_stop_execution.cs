using NUnit.Framework;
using Megawastu.Valas.KursProvider.Application;
using System.Threading;
using System;

namespace Megawastu.Valas.KursProvider.Specs
{   
    [TestFixture]
    public class When_try_to_stop_execution
    {
        [Test]
        public void Should_stop_in_holiday()
        {
            HolidayPauseTimer holidayPauseTimer = new HolidayPauseTimer();
            holidayPauseTimer.OnHolidayStart += new System.Action(holidayPauseTimer_OnHolidayStart);
            holidayPauseTimer.OnHolidayEnd += new Action(holidayPauseTimer_OnHolidayEnd);

            holidayPauseTimer.Start();
            lock (this)
            {
                Monitor.Wait(this);
            }
        }

        void holidayPauseTimer_OnHolidayEnd()
        {
            Console.WriteLine("Holiday End");
        }

        void holidayPauseTimer_OnHolidayStart()
        {
            Console.WriteLine("Holiday Start");
        }
    }
}
