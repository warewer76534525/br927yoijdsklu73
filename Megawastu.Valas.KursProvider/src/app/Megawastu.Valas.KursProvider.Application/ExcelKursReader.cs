using System;
using System.Collections.Generic;
using Excel = Microsoft.Office.Interop.Excel;
using Megawastu.Valas.KursProvider.ViewModel;
using Microsoft.Office.Interop.Excel;

namespace Megawastu.Valas.KursProvider.Application
{
    public class ExcelKursReader
    {
        private string excelPath;

        Excel.Application xlApp;
        Excel.Workbook xlWorkBook;
        Excel.Worksheet xlWorkSheet;

        public ExcelKursReader()
        {
            excelPath = KursProviderConfig.EXCEL_RATE_SOURCE_LOCATION;
        }

        public ExcelKursReader(string path)
        {
            excelPath = path;
        }

        public Rates GetAllRates()
        {    
            //xlWorkSheet.Change += new Excel.DocEvents_ChangeEventHandler(xlWorkSheet_Change);
           Range excelRange = xlWorkSheet.UsedRange;
            object[,] valueArray = (object[,])excelRange.get_Value(
                XlRangeValueDataType.xlRangeValueDefault);

            return ConvertToRates(valueArray);
        }

        private Rates ConvertToRates(object[,] valueArray)
        {
            IList<Kurs> dollarKursList = new List<Kurs>();

            for (int i = 0; i < 19; i++)
            {
                dollarKursList.Add(new Kurs { currency = valueArray[22 + i, 1].ToString().TrimEnd('='), bid = ConvertToDoubleTwoDecimal(valueArray[22 + i, 2]), ask = ConvertToDoubleTwoDecimal(valueArray[22 + i, 3]) });
            }


            for (int i = 0; i < 18; i++)
            {
                dollarKursList.Add(new Kurs { currency = valueArray[45 + i, 1].ToString().TrimEnd('='), bid = ConvertToDoubleTwoDecimal(valueArray[22 + i, 2]), ask = ConvertToDoubleTwoDecimal(valueArray[45 + i, 3]) });
            }

            return new Rates { rates = dollarKursList};
        }

        public void Open()
        {
            //xlApp.Visible = true;
            //xlApp.UserControl = true;
            xlApp = new Excel.ApplicationClass();
            xlWorkBook = xlApp.Workbooks.Open(excelPath, 0, true, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", true, true, 0, true, 1, 0);
            
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
        }

        private double ConvertToDoubleTwoDecimal(object number) 
        {
            return double.Parse(Convert.ToDouble(number).ToString("####0.0000"));
        }

        public void Close()
        {
            xlWorkBook.Close(false, System.Reflection.Missing.Value, System.Reflection.Missing.Value);
            xlApp.Quit();

            releaseObject(xlWorkSheet);
            releaseObject(xlWorkBook);
            releaseObject(xlApp);
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
