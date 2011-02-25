using Quartz;
using System;

namespace Megawastu.Valas.KursProvider.Application
{
    public class DateJob : IJob
    {
        public void Execute(JobExecutionContext context)
        {
            JobDataMap dataMap = context.JobDetail.JobDataMap;
            Action action = (Action)dataMap["Listener"];
            action();
        }
    }
}
