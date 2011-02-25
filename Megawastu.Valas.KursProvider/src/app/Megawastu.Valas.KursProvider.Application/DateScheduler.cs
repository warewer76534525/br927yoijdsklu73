
using System;
using Quartz;
using Quartz.Impl;
namespace Megawastu.Valas.KursProvider.Application
{
    public class DateScheduler
    {
        private ISchedulerFactory schedFact = new StdSchedulerFactory();
        private IScheduler sched;                
        
        public DateScheduler()
        {
            sched = schedFact.GetScheduler();
            sched.Start();
        }

        public void Schedule(DateTime date, Action action) 
        {
            JobDetail jobDetail = new JobDetail(Guid.NewGuid().ToString(), null, typeof(DateJob));
            jobDetail.JobDataMap["Listener"] = action;
            SimpleTrigger trigger = new SimpleTrigger(Guid.NewGuid().ToString(),
                                          null,
                                          date,
                                          null,
                                          0,
                                          TimeSpan.Zero);
            
            sched.ScheduleJob(jobDetail, trigger);
        }
    }
}
