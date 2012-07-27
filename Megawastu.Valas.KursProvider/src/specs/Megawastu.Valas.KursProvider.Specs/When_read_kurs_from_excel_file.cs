using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;
using Megawastu.Valas.KursProvider.Application;
using NUnit.Framework;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    class When_read_kurs_from_excel_file
    {
        private ExcelKursReader _reader;

        [SetUp]
        public void SetUp()
        {
            Console.WriteLine(ConfigurationManager.AppSettings["excel_location"]);
            _reader = new ExcelKursReader(ConfigurationManager.AppSettings["excel_location"]);
            _reader.Open();
        }

        [Test]
        public void Should_read_value_as_expected()
        {
            var rates = _reader.GetAllRates();
            var XAU= rates.rates.FirstOrDefault(x => x.currency == "XAU");

            Console.WriteLine(XAU.bid);
            
            Assert.IsTrue(XAU.bid == 1229.54);
        }

        [TearDown]
        public void TearDown()
        {

            try
            {
                _reader.Close();
            }
            catch 
            {
                
            
            }
            
        }
    }
}

