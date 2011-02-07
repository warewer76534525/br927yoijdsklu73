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

            RunConfiguration cfg = RunnerConfigurator.New(x =>
            {
                x.ConfigureService<KursProviderService>(s =>               
                {
                    s.Named("tc");                                
                    s.HowToBuildService(name => new KursProviderService());  
                    s.WhenStarted(tc => tc.Start());              
                    s.WhenStopped(tc => tc.Stop());               
                });
                x.RunAsLocalSystem();                            

                x.SetDescription("Megawastu Kurs Provider Service");
                x.SetDisplayName("Megawastu Kurs Provider Service");
                x.SetServiceName("Megawastu Kurs Provider Service");
            });
            Runner.Host(cfg, args);
            
        }
    }
}
