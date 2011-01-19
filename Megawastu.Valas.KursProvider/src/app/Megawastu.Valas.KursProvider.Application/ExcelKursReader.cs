using System;
using System.Collections.Generic;
using Excel = Microsoft.Office.Interop.Excel;
using Megawastu.Valas.KursProvider.ViewModel;
using System.IO;
using Microsoft.Office.Interop.Excel;

namespace Megawastu.Valas.KursProvider.Application
{
    public class ExcelKursReader
    {
        string excelPath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "ratesource.xls");

        Excel.Application xlApp = new Excel.ApplicationClass();
        Excel.Workbook xlWorkBook;
        Excel.Worksheet xlWorkSheet;
        object misValue = System.Reflection.Missing.Value;
        

        public IList<Kurs> GetKursInDollar()
        {    
            //xlWorkSheet.Change += new Excel.DocEvents_ChangeEventHandler(xlWorkSheet_Change);
           Range excelRange = xlWorkSheet.UsedRange;
            object[,] valueArray = (object[,])excelRange.get_Value(
                XlRangeValueDataType.xlRangeValueDefault);
            
            return ConvertToKurs(valueArray);
        }

        private IList<Kurs> ConvertToKurs(object[,] valueArray)
        {
            IList<Kurs> kursList = new List<Kurs>();

            for (int i = 0; i < 19; i++)
            {
                kursList.Add(new Kurs { Currency = valueArray[22 + i, 1].ToString().TrimEnd('='), Ask = Convert.ToDouble(valueArray[22 + i, 2]), Bid = Convert.ToDouble(valueArray[22 + i, 3]) });
            }

            return kursList;
        }

        public void Open()
        {
            //xlApp.Visible = true;
            //xlApp.UserControl = true;

            xlWorkBook = xlApp.Workbooks.Open(excelPath, 0, false, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", false, true, 0, true, 1, 0);
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
        }

        public void Close()
        {
            xlWorkBook.Close(false, misValue, misValue);
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
