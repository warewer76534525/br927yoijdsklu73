using NUnit.Framework;
using Excel = Microsoft.Office.Interop.Excel;
using System.IO;
using System;
using System.Threading;
using System.Diagnostics;
using System.Reflection;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_detect_change_in_excel
    {
        [Test]
        public void Should_detect_row_and_value_changed()
        {
            
            Excel.Application xlApp;
            Excel.Workbook xlWorkBook;
            Excel.Worksheet xlWorkSheet;
            object misValue = System.Reflection.Missing.Value;

            xlApp = new Excel.ApplicationClass();

            string excelPath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "ratesource.xls");
            xlWorkBook = xlApp.Workbooks.Open(excelPath, 0, false, 5, "", "", true, Microsoft.Office.Interop.Excel.XlPlatform.xlWindows, "\t", false, true, 0, true, 1, 0);
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
            //xlWorkSheet.Activate();
            xlWorkSheet.Change += new Excel.DocEvents_ChangeEventHandler(xlWorkSheet_Change);
            
            lock (this)
            {
                Monitor.Wait(this);
            }

            xlWorkBook.Close(false, misValue, misValue);
            xlApp.Quit();

            releaseObject(xlWorkSheet);
            releaseObject(xlWorkBook);
            releaseObject(xlApp);
        }

        void xlWorkSheet_Change(Excel.Range Target)
        {
            //Console.WriteLine("{0}:{1} -> {2}", Target.Row, Target.Column, Target.Value2.ToString());
            //Console.WriteLine(Target.Count);
            //Called when a cell or cells on a worksheet are changed.
            Debug.WriteLine("Delegate: You Changed Cells " +
               Target.get_Address(Missing.Value, Missing.Value,
               Excel.XlReferenceStyle.xlA1, Missing.Value, Missing.Value) +
               " on " + Target.Worksheet.Name);
        }

        private void releaseObject(object obj)
        {
            try
            {
                System.Runtime.InteropServices.Marshal.ReleaseComObject(obj);
                obj = null;
            }
            catch (Exception ex)
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
