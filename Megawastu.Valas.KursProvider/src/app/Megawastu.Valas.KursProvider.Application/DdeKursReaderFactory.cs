using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Megawastu.Valas.KursProvider.ViewModel;
using Excel = Microsoft.Office.Interop.Excel;
using Microsoft.Office.Interop.Excel;

namespace Megawastu.Valas.KursProvider.Application
{
    class DdeKursReaderFactory
    {
        readonly string _excelPath = KursProviderConfig.EXCEL_RATE_SOURCE_LOCATION;

        Excel.Application _xlApp;
        Workbook _xlWorkBook;
        Worksheet _xlWorkSheet;
        readonly object _misValue = System.Reflection.Missing.Value;

        public DdeKursReader Create()
        {
            Open();
            var advisors = GetAllAdvisors();
            Close();
            return new DdeKursReader(advisors);
        }

        private List<DdeKursAdvisor> GetAllAdvisors()
        {
            var advisors = new List<DdeKursAdvisor>();

            Range excelRange = _xlWorkSheet.UsedRange;
            var valueArray = (object[,])excelRange.get_Value(
                XlRangeValueDataType.xlRangeValueDefault);

            for (int i = 0; i < 19; i++)
            {
                var kurs = new Kurs
                    {
                        currency = valueArray[22 + i, 1].ToString().TrimEnd('='),
                        ask = ConvertToDoubleTwoDecimal(valueArray[22 + i, 2]),
                        bid = ConvertToDoubleTwoDecimal(valueArray[22 + i, 3])
                    };
                var bidCell = string.Format("R{0}C2", 22+i );
                var askCell = string.Format("R{0}C3", 22 + i);

                advisors.Add(new DdeKursAdvisor(kurs, bidCell, askCell));
            }


            for (int i = 0; i < 19; i++)
            {
                var kurs = new Kurs
                {
                    currency = valueArray[44 + i, 1].ToString().TrimEnd('='),
                    ask = ConvertToDoubleTwoDecimal(valueArray[44 + i, 2]),
                    bid = ConvertToDoubleTwoDecimal(valueArray[44 + i, 3])
                };
                var bidCell = string.Format("R{0}C2", 22 + i);
                var askCell = string.Format("R{0}C3", 22 + i);

                advisors.Add(new DdeKursAdvisor(kurs, bidCell, askCell));
            }

            return advisors;
        }

        public void Open()
        {
            //xlApp.Visible = true;
            //xlApp.UserControl = true;
            _xlApp = new Microsoft.Office.Interop.Excel.ApplicationClass();
            _xlWorkBook = _xlApp.Workbooks.Open(_excelPath, 0, true, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", true, true, 0, true, 1, 0);

            _xlWorkSheet = (Microsoft.Office.Interop.Excel.Worksheet)_xlWorkBook.Worksheets.get_Item(1);
        }

        private double ConvertToDoubleTwoDecimal(object number)
        {
            return double.Parse(Convert.ToDouble(number).ToString("####0.0000"));
        }

        public void Close()
        {
            _xlWorkBook.Close(false, _misValue, _misValue);
            _xlApp.Quit();

            releaseObject(_xlWorkSheet);
            releaseObject(_xlWorkBook);
            releaseObject(_xlApp);
        }

        private void releaseObject(object obj)
        {
            try
            {
                System.Runtime.InteropServices.Marshal.ReleaseComObject(obj);
                obj = null;
            }
            catch (Exception)
            {
                obj = null;
            }
            finally
            {
                GC.Collect();
            }
        }
    }
}
