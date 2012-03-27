
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using System.Threading;
using System;
using NLog;

namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        private static readonly Logger Logger = LogManager.GetCurrentClassLogger();
        ExcelKursReader reader = new ExcelKursReader();
        private volatile bool running = true;

        public void Start()
        {
            KursPublisher publisher = new KursPublisher();
            
            reader.Open();

            while (running)
            {
                try
                {
                    Rates rates = reader.GetAllRates();
                    publisher.Publish(rates);
                    Logger.Info("Publish rate {0}", rates);

                    Thread.Sleep(5000); // TODO atur sleep -> bisa diganti menjadi real times
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.Message);
                }
            }

            reader.Close();
        }

        public void Stop()
        {
            running = false;
        }

        //~KursExcelProvider()
        //{
        //    reader.Close();
        //}
    }
}
