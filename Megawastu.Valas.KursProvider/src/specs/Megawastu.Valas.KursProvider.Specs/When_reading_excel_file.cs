using System;
using Excel = Microsoft.Office.Interop.Excel;
using System.Threading;
using System.IO;

namespace Megawastu.Valas.KursProvider.Specs
{
    public class When_reading_excel_file
    {
        public void Should_read_value_repeatedly()
        {
            Excel.Application xlApp;
            Excel.Workbook xlWorkBook;
            Excel.Worksheet xlWorkSheet;
            object misValue = System.Reflection.Missing.Value;

            xlApp = new Excel.ApplicationClass();
            //xlApp.Visible = true;
            //xlApp.UserControl = true;
            string excelPath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "ratesource.xls");
            xlWorkBook = xlApp.Workbooks.Open(excelPath, 0, false, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", false, true, 0, true, 1, 0);
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
            //xlWorkSheet.Change += new Excel.DocEvents_ChangeEventHandler(xlWorkSheet_Change);
            
            for (int i = 0; i < 100; i++)
            {
                Console.WriteLine(xlWorkSheet.get_Range("B23", "B23").Value2.ToString());
                //xlWorkSheet.
                Thread.Sleep(1000);
            }

            xlWorkBook.Close(false, misValue, misValue);
            xlApp.Quit();

            releaseObject(xlWorkSheet);
            releaseObject(xlWorkBook);
            releaseObject(xlApp);
        }

        void xlWorkSheet_Change(Excel.Range Target)
        {
            Console.WriteLine("Changed");
        }

        private void releaseObject(object obj)
        {
            try
            {
                System.Runtime.InteropServices.Marshal.ReleaseComObject(obj);
                obj = null;
            }
            catch
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
