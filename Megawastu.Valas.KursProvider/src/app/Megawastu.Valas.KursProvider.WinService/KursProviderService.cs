using System;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;
using NLog;

namespace Megawastu.Valas.KursProvider.WinService
{
    class KursProviderService
    {
        private static readonly Logger Logger = LogManager.GetCurrentClassLogger();

        readonly KursExcelProvider _kursExcelProvider = new KursExcelProvider();
        readonly ExcelKiller _excelKiller = new ExcelKiller();
        readonly HolidayPauseTimer _holidayPauseTimer = new HolidayPauseTimer();
        private Thread _thread;

        public void Start()
        {
            _thread = new Thread(() =>
            {
                Logger.Info("Start The tread");
                _holidayPauseTimer.Start();
                _kursExcelProvider.Start();
            });

            _holidayPauseTimer.OnHolidayStart += holidayPauseTimer_OnHolidayStart;
            _holidayPauseTimer.OnHolidayEnd += holidayPauseTimer_OnHolidayEnd;

            _thread.IsBackground = true;

            _thread.Start();
        }

        void holidayPauseTimer_OnHolidayEnd()
        {
            _kursExcelProvider.Start();
        }

        void holidayPauseTimer_OnHolidayStart()
        {
            _kursExcelProvider.Stop();
        }

        public void Stop()
        {
            Logger.Info("Shutdown begin.");
            _kursExcelProvider.Stop();
            _thread.Join();

            try
            {
                _excelKiller.KillExcelProcessForThisApp();    
            }
            catch (Exception)
            {
            
            }
            
            Logger.Info("Shutdown done.");
        }
    }
}
