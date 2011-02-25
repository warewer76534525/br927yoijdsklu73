using NUnit.Framework;
using Megawastu.Valas.KursProvider.Application;
using System;
using System.Threading;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_create_date_scheduler
    {
        [Test]
        public void Should_execute_in_choosen_date()
        {
            DateScheduler scheduler = new DateScheduler();
            scheduler.Schedule(DateTime.Now.AddSeconds(10).ToUniversalTime(), () => { Console.WriteLine("Executed 1"); });
            scheduler.Schedule(DateTime.Now.AddSeconds(15).ToUniversalTime(), () => { Console.WriteLine("Executed 2"); });
            Thread.Sleep(20000);
        }

        [Test]
        public void Should_show_datetime_diff_with_utc()
        {
            DateTime dateTime = new DateTime(2010, 1, 1);
            Console.WriteLine(dateTime);
            Console.WriteLine(dateTime.ToUniversalTime());
            Console.WriteLine(DateTime.Now);
            Console.WriteLine(DateTime.UtcNow);
        }
    }
}
