using System;
using System.Threading;
using Megawastu.Valas.KursProvider.Application;

namespace Megawastu.Valas.KursProvider.WinService
{
    class KursProviderService
    {
        KursExcelProvider kursExcelProvider = new KursExcelProvider();
        ExcelKiller excelKiller = new ExcelKiller();
        HolidayPauseTimer holidayPauseTimer = new HolidayPauseTimer();

        public void Start()
        {
            Thread thread = new Thread(() =>
            {
                kursExcelProvider.Start();
                holidayPauseTimer.Start();
            });

            holidayPauseTimer.OnHolidayStart += new Action(holidayPauseTimer_OnHolidayStart);
            holidayPauseTimer.OnHolidayEnd += new Action(holidayPauseTimer_OnHolidayEnd);

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
