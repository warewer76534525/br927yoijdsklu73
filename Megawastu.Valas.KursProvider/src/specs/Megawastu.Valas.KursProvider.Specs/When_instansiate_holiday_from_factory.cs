using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Megawastu.Valas.KursProvider.Application;
using NUnit.Framework;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    class When_instansiate_holiday_from_factory
    {
        [Test]
        public void Should_register_holiday_from_configuration()
        {
            HolidayCalandarFactory.GetInstance();
        }
    }
}
