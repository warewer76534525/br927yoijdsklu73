using System;
using System.Collections.Generic;

namespace Megawastu.Valas.KursProvider.Application
{
    public class HolidayCalandarFactory
    {
        private static HolidayCalendar _holidayCalendar;

        public static HolidayCalendar GetInstance()
        {
            if (_holidayCalendar == null)
            {
                LoadHolidays();
            }

            return _holidayCalendar;
        }

        private static void LoadHolidays()
        {
            var holidayList = KursProviderConfig.HOLIDAY_DATE_LIST;
            var holidayDates = holidayList.Split(',');
            var holidays = new List<Holidays>();

            foreach (var holidayDate in holidayDates)
            {
                var dateMonth = holidayDate.Split('.');
                holidays.Add(
                    new Holidays
                        {
                            Day = Convert.ToInt32(dateMonth[0]),
                            Month = Convert.ToInt32(dateMonth[1])
                        }
                    );
            }

            _holidayCalendar = new HolidayCalendar(holidays);
        }
    }
}
