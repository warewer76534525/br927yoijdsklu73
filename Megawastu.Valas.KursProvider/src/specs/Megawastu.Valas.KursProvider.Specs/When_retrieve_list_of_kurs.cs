
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
            IList<Kurs> allKurs = reader.GetKurs();
            Assert.IsFalse(allKurs.Count == 0);

            foreach (var kurs in allKurs)
            {
                Console.WriteLine("{0} : {1} {2}", kurs.currency, kurs.ask, kurs.bid);
            }

            reader.Close();
        }
    }
}
