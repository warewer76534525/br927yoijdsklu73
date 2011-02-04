
using System.IO;
using System;
using System.Configuration;
namespace Megawastu.Valas.KursProvider.Application
{
    public static class KursProviderConfig
    {
        public static string MONEY_CHANGER_REST_URL { get; private set; }
        public static string EXCEL_RATE_SOURCE_LOCATION { get; set; }

        static KursProviderConfig()
        {
            MONEY_CHANGER_REST_URL = ConfigurationManager.AppSettings["rest_location"];
            EXCEL_RATE_SOURCE_LOCATION = ConfigurationManager.AppSettings["excel_location"];
        }
    }
}
