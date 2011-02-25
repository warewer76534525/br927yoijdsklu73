using NUnit.Framework;
using Quartz;
using Quartz.Impl;
using System;
using System.Threading;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_create_scheduler_quartz
    {
        [Test]
        public void Should_execute_in_interval()
        {
            ISchedulerFactory schedFact = new StdSchedulerFactory();
            IScheduler sched = schedFact.GetScheduler();
            sched.Start();

            JobDetail jobDetail = new JobDetail("myJob", null, typeof(HelloJob));
            
            Trigger trigger = TriggerUtils.MakeSecondlyTrigger();
            
            //trigger.StartTimeUtc = TriggerUtils.GetEvenHourDate(DateTime.UtcNow);
            trigger.Name = "myTrigger";
            sched.ScheduleJob(jobDetail, trigger);

            Thread.Sleep(100000);
        }

        [Test]
        public void Should_execute_in_selected_day()
        {
            ISchedulerFactory schedFact = new StdSchedulerFactory();
            IScheduler sched = schedFact.GetScheduler();
            sched.Start();

            JobDetail jobDetail = new JobDetail("myJob", null, typeof(HelloJob));
            SimpleTrigger trigger = new SimpleTrigger("myTrigger",
                                          null,
                                          DateTime.Now.ToUniversalTime(),
                                          null,
                                          0,
                                          TimeSpan.Zero);

            //trigger.StartTimeUtc = TriggerUtils.GetEvenHourDate(DateTime.UtcNow);
            trigger.Name = "myTrigger";
            sched.ScheduleJob(jobDetail, trigger);

            Thread.Sleep(100000);
        }
    }
}
