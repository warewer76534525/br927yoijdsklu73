
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using System.Threading;
using System;
namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        ExcelKursReader reader = new ExcelKursReader();
        private volatile bool running = false;

        public void Start()
        {
            KursPublisher publisher = new KursPublisher();
            
            running = true;

            reader.Open();

            while (running)
            {
                try
                {
                    Rates rates = reader.GetAllRates();
                    publisher.Publish(rates);

                    Thread.Sleep(2000); // TODO atur sleep -> bisa diganti menjadi real times
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
