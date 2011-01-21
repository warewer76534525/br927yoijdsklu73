using NUnit.Framework;
using Megawastu.Valas.KursProvider.Application;
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using Newtonsoft.Json;
using System;
namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_upload_kurs_to_endpoint
    {
        [Test]
        public void Should_post_data_to_endpoint()
        {
            KursPublisher publisher = new KursPublisher();

            publisher.Publish(new List<Kurs> 
                { 
                    new Kurs{ currency = "IDR", ask = 8.867, bid = 8.999 }, 
                    new Kurs{ currency = "EUR", ask = 8.867, bid = 8.999 }, 
                    new Kurs{ currency = "AUD", ask = 8.867, bid = 8.999 }, 
                });
        }

        [Test]
        public void Should_convert_to_json_string() 
        {
            string json = JsonConvert.SerializeObject(new List<Kurs> 
            { 
                new Kurs{ currency = "IDR", ask = 8.867, bid = 8.999 }, 
                new Kurs{ currency = "EUR", ask = 8.867, bid = 8.999 }, 
                new Kurs{ currency = "AUD", ask = 8.867, bid = 8.999 }, 
            });

            Assert.IsNotEmpty(json);
            Console.WriteLine(json);
        }
    }
}
