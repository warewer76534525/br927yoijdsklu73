
using System;
namespace Megawastu.Valas.KursProvider.Application
{
    public class HolidayPauseTimer
    {
        public event Action OnHolidayStart;
        public event Action OnHolidayEnd;
        private HolidayCalendar _holidayCalendar = new HolidayCalendar();
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
            ScheduleNextHoliday(_holidayCalendar.NextHoliday);
        }
    }
}
