﻿using System.Collections.Generic;
using Megawastu.Valas.KursProvider.ViewModel;
using System.Net;
using Newtonsoft.Json;

namespace Megawastu.Valas.KursProvider.Application
{
    public class KursPublisher
    {
        WebClient webClient = new WebClient();
        static readonly string MONEY_CHANGER_ENDPOINT = "http://localhost:8080/moneychanger/rest/rates";

        public void Publish(IList<Kurs> dollarKurs)
        {
            webClient.Headers[HttpRequestHeader.ContentType] = "application/json";
            webClient.UploadString(MONEY_CHANGER_ENDPOINT, Serialize(dollarKurs));
        }

        private string Serialize(IList<Kurs> dollarKurs)
        {
            return JsonConvert.SerializeObject(dollarKurs);
        }
    }
}
