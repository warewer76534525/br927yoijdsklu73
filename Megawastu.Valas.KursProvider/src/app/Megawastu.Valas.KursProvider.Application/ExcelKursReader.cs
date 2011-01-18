using System;
using System.Collections.Generic;
using Excel = Microsoft.Office.Interop.Excel;
using Megawastu.Valas.KursProvider.ViewModel;
using System.IO;

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
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
            //xlWorkSheet.Change += new Excel.DocEvents_ChangeEventHandler(xlWorkSheet_Change);

            Console.WriteLine(xlWorkSheet.get_Range("B23", "B23").Value2.ToString());

            //for
            return null;
        }

        public void Open()
        {
            //xlApp.Visible = true;
            //xlApp.UserControl = true;

            xlWorkBook = xlApp.Workbooks.Open(excelPath, 0, false, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", false, true, 0, true, 1, 0);
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
