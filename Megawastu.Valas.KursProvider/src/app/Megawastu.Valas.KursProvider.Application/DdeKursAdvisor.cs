using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Megawastu.Valas.KursProvider.ViewModel;
using NDde.Client;

namespace Megawastu.Valas.KursProvider.Application
{
    public class DdeKursAdvisor
    {
        private readonly string _bidCell;
        private readonly string _askCell;
        private readonly Kurs _kurs;
        private readonly DdeClient _bidClient = new DdeClient("Excel", "source");
        private readonly DdeClient _askClient = new DdeClient("Excel", "source");

        public DdeKursAdvisor(string currency, string bidCell, string askCell)
        {
            _bidCell = bidCell;
            _askCell = askCell;
            _kurs = new Kurs {currency = currency};
        }

        public DdeKursAdvisor(Kurs kurs, string bidCell, string askCell)
        {
            _kurs = kurs;
            _bidCell = bidCell;
            _askCell = askCell;
        }

        public void StartAdvise()
        {
            _bidClient.Connect();
            _bidClient.StartAdvise(_bidCell, 1, true, 60000);
            _bidClient.Advise += BidKursUpdated_Advise;

            _askClient.Connect();
            _askClient.StartAdvise(_askCell, 1, true, 60000);
            _askClient.Advise += AskKursUpdated_Advise;
        }

        void BidKursUpdated_Advise(object sender, DdeAdviseEventArgs e)
        {
             var bid = ConvertToDoubleTwoDecimal(e.Text.Substring(0, e.Text.Length - 3));
            _kurs.bid = bid;
        }

        void AskKursUpdated_Advise(object sender, DdeAdviseEventArgs e)
        {
            var ask = ConvertToDoubleTwoDecimal(e.Text.Substring(0, e.Text.Length - 3));
            _kurs.ask = ask;
        }
        private double ConvertToDoubleTwoDecimal(object number)
        {
            return double.Parse(Convert.ToDouble(number).ToString("####0.0000"));
        }

        public Kurs Kurs
        {
            get {return _kurs;}
        }

        public void StopAdvise()
        {
            _bidClient.Disconnect();
            _askClient.Disconnect();
        }
    }
}
