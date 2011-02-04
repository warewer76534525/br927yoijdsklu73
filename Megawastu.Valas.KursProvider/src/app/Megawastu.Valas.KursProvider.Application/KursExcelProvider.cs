
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using System.Threading;
using System;
namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        ExcelKursReader reader = new ExcelKursReader();

        public void Start()
        {
            KursPublisher publisher = new KursPublisher();

            reader.Open();
            // TODO can be paralalize
            while (true)
            {
                try
                {
                    IList<Kurs> dollarKurs = reader.GetKurs();
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
            reader.Close();
        }

        ~KursExcelProvider()
        {
            reader.Close();
        }
    }
}
