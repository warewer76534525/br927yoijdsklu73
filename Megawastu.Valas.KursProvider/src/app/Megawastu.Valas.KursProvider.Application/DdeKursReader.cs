using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Megawastu.Valas.KursProvider.ViewModel;

namespace Megawastu.Valas.KursProvider.Application
{
    public class DdeKursReader
    {
        private readonly IList<DdeKursAdvisor> _kursAdvisors;

        public DdeKursReader(IList<DdeKursAdvisor> kursAdvisors)
        {
            _kursAdvisors = kursAdvisors;
        }

        public void Connect()
        {
            foreach (var ddeKursAdvisor in _kursAdvisors)
            {
                ddeKursAdvisor.StartAdvise();
            }
        }

        public void Disconnect()
        {
            foreach (var ddeKursAdvisor in _kursAdvisors)
            {
                ddeKursAdvisor.StopAdvise();
            }
        }

        public Rates GetAllRates()
        {
            IList<Kurs> dollarKursList = _kursAdvisors.Select(advisor => advisor.Kurs).ToList();

            return new Rates { rates = dollarKursList };
        }
    }
}
