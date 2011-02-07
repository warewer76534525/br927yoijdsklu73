using System.Collections.Generic;

namespace Megawastu.Valas.KursProvider.ViewModel
{
    public class Rates
    {
        public IList<Kurs> idrRates { get; set; }
        public IList<Kurs> dollarRates { get; set; }
    }
}
