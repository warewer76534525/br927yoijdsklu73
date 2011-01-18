using NUnit.Framework;
using Megawastu.Valas.KursProvider.Application;
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
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
                new Kurs{ Currency = "IDR", Ask = 8.867, Bid = 8.999 }, 
                new Kurs{ Currency = "EUR", Ask = 8.867, Bid = 8.999 }, 
                new Kurs{ Currency = "AUD", Ask = 8.867, Bid = 8.999 }, 
            });
        }
    }
}
