using System.Collections.Generic;
using Megawastu.Valas.KursProvider.ViewModel;
using System.Net;
using Newtonsoft.Json;

namespace Megawastu.Valas.KursProvider.Application
{
    public class KursPublisher
    {
        WebClient webClient = new WebClient();
        static readonly string MONEY_CHANGER_ENDPOINT = KursProviderConfig.MONEY_CHANGER_REST_URL;

        public void Publish(IList<Kurs> dollarKurs)
        {
            webClient.Headers[HttpRequestHeader.ContentType] = "application/json";
            webClient.UploadString(MONEY_CHANGER_ENDPOINT, Serialize(new Rates { rates = dollarKurs }));
        }

        private string Serialize(Rates dollarKurs)
        {
            return JsonConvert.SerializeObject(
                dollarKurs
            );
        }
    }
}
