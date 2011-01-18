using System.Collections.Generic;
using Megawastu.Valas.KursProvider.ViewModel;
using System.Net;
using Newtonsoft.Json;

namespace Megawastu.Valas.KursProvider.Application
{
    public class KursPublisher
    {
        WebClient webClient = new WebClient();
        static readonly string MONEY_CHANGER_ENDPOINT = "http://localhost/upload.php";

        public void Publish(IList<Kurs> dollarKurs)
        {
            webClient.UploadString(MONEY_CHANGER_ENDPOINT, Serialize(dollarKurs));
        }

        private string Serialize(IList<Kurs> dollarKurs)
        {
            return JsonConvert.SerializeObject(dollarKurs);
        }
    }
}
