using Megawastu.Valas.KursProvider.Application;
using System;
using Topshelf.Configuration;
using Topshelf;
using Topshelf.Configuration.Dsl;

namespace Megawastu.Valas.KursProvider.WinService
{
    class Program
    {
        //[STAThread]
        static void Main(string[] args)
        {

            RunConfiguration cfg = RunnerConfigurator.New(x =>   //1
            {
                x.ConfigureService<KursProviderService>(s =>               //2
                {
                    s.Named("tc");                                //3
                    s.HowToBuildService(name => new KursProviderService());  //4
                    s.WhenStarted(tc => tc.Start());              //5
                    s.WhenStopped(tc => tc.Stop());               //6
                });
                x.RunAsLocalSystem();                            //7

                x.SetDescription("Kurs Provider Service");        //8
                x.SetDisplayName("Kurs Provider Service");                       //9
                x.SetServiceName("Kurs Provider Service");                       //10
            });
            Runner.Host(cfg, args);
            
        }
    }
}
