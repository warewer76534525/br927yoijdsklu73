using System;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;
using NLog;

namespace Megawastu.Valas.KursProvider.WinService
{
    class KursProviderService
    {
        private static readonly Logger Logger = LogManager.GetCurrentClassLogger();

        readonly KursExcelProvider kursExcelProvider = new KursExcelProvider();
        readonly ExcelKiller excelKiller = new ExcelKiller();
        readonly HolidayPauseTimer holidayPauseTimer = new HolidayPauseTimer();

        public void Start()
        {
            var thread = new Thread(() =>
            {
                Logger.Info("Start The tread");
                holidayPauseTimer.Start();
                kursExcelProvider.Start();
            });

            holidayPauseTimer.OnHolidayStart += holidayPauseTimer_OnHolidayStart;
            holidayPauseTimer.OnHolidayEnd += holidayPauseTimer_OnHolidayEnd;

            thread.IsBackground = true;

            thread.Start();
        }

        void holidayPauseTimer_OnHolidayEnd()
        {
            kursExcelProvider.Start();
        }

        void holidayPauseTimer_OnHolidayStart()
        {
            kursExcelProvider.Stop();
        }

        public void Stop()
        {
            kursExcelProvider.Stop();
            excelKiller.KillExcelProcessForThisApp();
        }
    }
}
