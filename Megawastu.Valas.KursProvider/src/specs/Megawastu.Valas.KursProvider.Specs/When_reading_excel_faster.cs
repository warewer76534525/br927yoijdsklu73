using NUnit.Framework;
using Excel = Microsoft.Office.Interop.Excel;
using System.IO;
using System;
using Microsoft.Office.Interop.Excel;
using System.Threading;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_reading_excel_faster
    {
        [Test]
        public void Should_read_used_ranges()
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

            Range excelRange = xlWorkSheet.UsedRange;

            for (int i = 0; i < 10; i++)
            {
                object[,] valueArray = (object[,])excelRange.get_Value(
                XlRangeValueDataType.xlRangeValueDefault);

                Console.WriteLine(valueArray[22, 2]);
                Thread.Sleep(1000);
            }
        }
    }
}
