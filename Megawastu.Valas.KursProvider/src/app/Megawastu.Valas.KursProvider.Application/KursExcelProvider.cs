
using Megawastu.Valas.KursProvider.ViewModel;
using System.Collections.Generic;
using System.Threading;
using System;
using NLog;
using Newtonsoft.Json;

namespace Megawastu.Valas.KursProvider.Application
{
    public class KursExcelProvider
    {
        private static readonly Logger Logger = LogManager.GetCurrentClassLogger();
        private readonly DdeKursReader _reader = new DdeKursReaderFactory().Create();
        //ExcelKursReader reader = new ExcelKursReader();
        private volatile bool _running = true;

        public void Start()
        {
            var publisher = new KursPublisher();
            DdeConnect();

            while (_running)
            {
                try
                {
                    Rates rates = _reader.GetAllRates();

                    if (Logger.IsEnabled(LogLevel.Debug))
                        Logger.Debug(JsonConvert.SerializeObject(rates));

                    publisher.Publish(rates);
                }
                catch (Exception e)
                {
                    Logger.Error(e.Message);
                }
                Thread.Sleep(KursProviderConfig.EXCEL_READER_TIMER);
            }

            try
            {
                _reader.Disconnect();
            }
            catch
            {
               
            }
        }

        private void DdeConnect()
        {
            bool connected = false;
            do
            {
                try
                {
                    _reader.Connect();
                    connected = true;
                }
                catch
                {
                    Logger.Info("Excel is not open yet");
                    Thread.Sleep(5000);
                }       
            } while (!connected);
            
        }

        public void Stop()
        {
            _running = false;
        }

        //~KursExcelProvider()
        //{
        //    reader.Close();
        //}
    }
}
