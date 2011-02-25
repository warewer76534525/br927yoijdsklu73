using System;
using Quartz;

namespace Megawastu.Valas.KursProvider.Specs
{
    public class HelloJob : IJob
    {
        public void Execute(JobExecutionContext context)
        {
            Console.WriteLine("Execute");
        }
    }
}
