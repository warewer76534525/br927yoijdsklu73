﻿
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
            IList<Kurs> dollarKurs = reader.GetKursInDollar();
            Assert.IsFalse(dollarKurs.Count == 0);

            foreach (var kurs in dollarKurs)
            {
                Console.WriteLine("{0} : {1} {2}", kurs.Currency, kurs.Ask, kurs.Bid);
            }
            reader.Close();
        }
    }
}
