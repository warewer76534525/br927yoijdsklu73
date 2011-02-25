using NUnit.Framework;
using System.Threading;
using System;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_using_one_stop_timer
    {
        private Timer ticker;

        [Test]
        public void Should_execute_in_time()
        {
            ticker = new Timer(TimerMethod, null, 1000, 0);
            
            Thread.Sleep(10000);
        }

        public void TimerMethod(object state)
        {
            Console.WriteLine(".");
            ticker.Dispose();
        }
    }
}
