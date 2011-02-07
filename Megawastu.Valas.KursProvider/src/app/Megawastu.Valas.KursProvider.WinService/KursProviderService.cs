using System;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;

namespace Megawastu.Valas.KursProvider.WinService
{
    class KursProviderService
    {
        KursExcelProvider kursExcelProvider = new KursExcelProvider();
        ExcelKiller excelKiller = new ExcelKiller();

        public void Start()
        {
            Thread thread = new Thread(() =>
            {
                
                kursExcelProvider.Start();
            });
            
            thread.IsBackground = true;

            thread.Start();
        }

        public void Stop()
        {
            kursExcelProvider.Stop();
            excelKiller.KillExcelProcessForThisApp();
        }
    }
}
