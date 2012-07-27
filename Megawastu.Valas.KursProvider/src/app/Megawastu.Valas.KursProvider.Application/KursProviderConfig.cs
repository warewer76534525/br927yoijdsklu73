
using System.IO;
using System;
using System.Configuration;
namespace Megawastu.Valas.KursProvider.Application
{
    public  class KursProviderConfig
    {
        public static string MONEY_CHANGER_REST_URL = ConfigurationManager.AppSettings["rest_location"];
        public static string EXCEL_RATE_SOURCE_LOCATION = ConfigurationManager.AppSettings["excel_location"];
        public static string HOLIDAY_DATE_LIST = ConfigurationManager.AppSettings["holiday_date"];
        public static int EXCEL_READER_TIMER = int.Parse(ConfigurationManager.AppSettings["excel_read_timer"]);

        public static int BASE_IDR_ROW_START = int.Parse(ConfigurationManager.AppSettings["base_idr_start"]);
        public static int BASE_IDR_ROW_END = int.Parse(ConfigurationManager.AppSettings["base_idr_end"]);

        public static int BASE_USD_ROW_START = int.Parse(ConfigurationManager.AppSettings["base_usd_start"]);
        public static int BASE_USD_ROW_END = int.Parse(ConfigurationManager.AppSettings["base_usd_end"]);
    }
}

