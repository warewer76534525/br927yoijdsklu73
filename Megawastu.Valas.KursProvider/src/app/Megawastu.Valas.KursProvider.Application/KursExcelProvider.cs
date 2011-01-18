
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        public void Start()
        {

            ExcelKursReader reader = new ExcelKursReader();
            KursPublisher publisher = new KursPublisher();
            
            // TODO can be paralalize
            while (true)
            {
                IList<Kurs> dollarKurs = reader.GetKursInDollar();
                publisher.Publish(dollarKurs);
            }
        }
    }
}
