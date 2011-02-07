
using System.Collections.Generic;
using Megawastu.Valas.KursProvider.ViewModel;
using Megawastu.Valas.KursProvider.Application;
using NUnit.Framework;
using System;
namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_retrieve_list_of_kurs
    {
        [Test]
        public void Should_return_list_of_kurs()
        {
            ExcelKursReader reader = new ExcelKursReader();
            reader.Open();
            Rates allKurs = reader.GetAllRates();
            Assert.IsFalse(allKurs.rates.Count == 0);

            foreach (var kurs in allKurs.rates)
            {
                Console.WriteLine("{0} : {1} {2}", kurs.currency, kurs.ask, kurs.bid);
            }

            reader.Close();
        }
    }
}
