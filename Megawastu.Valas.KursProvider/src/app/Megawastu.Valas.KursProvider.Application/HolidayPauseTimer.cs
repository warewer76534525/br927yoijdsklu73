
using System;
using NLog;

namespace Megawastu.Valas.KursProvider.Application
{
    public class HolidayPauseTimer
    {
        private static readonly Logger Logger = LogManager.GetCurrentClassLogger();

        public event Action OnHolidayStart;
        public event Action OnHolidayEnd;
        private HolidayCalendar _holidayCalendar = HolidayCalandarFactory.GetInstance();
        private bool inHoliday = false;
        private DateScheduler _dateScheduler = new DateScheduler();

        private void ScheduleNextHoliday(DateTime dateTime)
        {
            _dateScheduler.Schedule(dateTime, TimerExecuted);
        }

        private void ScheduleEndingHoliday(DateTime dateTime)
        {
            _dateScheduler.Schedule(dateTime.AddDays(1), TimerExecuted);
        }

        public void TimerExecuted()
        {
            if (inHoliday)
            {
                ScheduleNextHoliday(_holidayCalendar.NextHoliday);
                OnHolidayEnd();
            }
            else
            {
                ScheduleEndingHoliday(_holidayCalendar.NextHoliday);
                inHoliday = true;
                OnHolidayStart();
            }
        }

        public void Start()
        {
            Logger.Info("Start Holiday Timer");
            if (_holidayCalendar.IsNowHoliday()) {
                Logger.Info("Now Is Holiday, Stop Publisher");
                ScheduleEndingHoliday(_holidayCalendar.NextHoliday);
                inHoliday = true;
                OnHolidayStart();
            }
            else
            {
                ScheduleNextHoliday(_holidayCalendar.NextHoliday);   
            }
        }
    }
}
