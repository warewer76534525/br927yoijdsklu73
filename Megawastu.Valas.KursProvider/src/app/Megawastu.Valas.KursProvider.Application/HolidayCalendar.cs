using System;
using System.Collections.Generic;
using System.Linq;

namespace Megawastu.Valas.KursProvider.Application
{
    public class HolidayCalendar
    {
        private IList<Holidays> _holidays = new List<Holidays>();

        public HolidayCalendar()
        {
            RegisterHoliday(new Holidays { Day = 1, Month = 1 });
            RegisterHoliday(new Holidays { Day = 25, Month = 12 }); 
        }

        private void RegisterHoliday(Holidays holidays)
        {
            _holidays.Add(holidays);
        }

        public DateTime NextHoliday 
        {
            get
            {
                Holidays nextHoliday = _holidays.Where(x => x.Month >= DateTime.Now.Month && x.Day >= DateTime.Now.Day).FirstOrDefault();

                if (nextHoliday == null) 
                {
                    Holidays nextYearHoliday = _holidays.First();
                    return new DateTime(DateTime.Now.Year + 1, nextYearHoliday.Month, nextYearHoliday.Day).ToUniversalTime();
                }

                return new DateTime(DateTime.Now.Year, nextHoliday.Month, nextHoliday.Day).ToUniversalTime();
            }
        }
    }
}
