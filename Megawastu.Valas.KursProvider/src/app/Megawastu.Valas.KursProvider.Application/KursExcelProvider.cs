
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using System.Threading;
using System;
namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        public void Start()
        {

            ExcelKursReader reader = new ExcelKursReader();
            KursPublisher publisher = new KursPublisher();

            reader.Open();
            // TODO can be paralalize
            while (true)
            {
                try
                {
                    IList<Kurs> dollarKurs = reader.GetKursInDollar();
                    publisher.Publish(dollarKurs);

                    Thread.Sleep(2000); // TODO atur sleep -> bisa diganti menjadi real times
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.Message);
                }
            }
        }

        public void Stop()
        {
            
        }
    }
}
