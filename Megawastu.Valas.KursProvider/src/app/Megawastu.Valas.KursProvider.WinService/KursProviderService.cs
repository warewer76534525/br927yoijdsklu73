using System;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;

namespace Megawastu.Valas.KursProvider.WinService
{
    class KursProviderService
    {
        KursExcelProvider kursExcelProvider = new KursExcelProvider();
        public void Start()
        {
            new Thread(() =>
            {
                
                kursExcelProvider.Start();
            }).Start();
        }

        public void Stop()
        {
            kursExcelProvider.Stop();
        }
    }
}
