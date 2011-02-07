using NUnit.Framework;
using Megawastu.Valas.KursProvider.Application;
using System.Diagnostics;
using System;
using System.Threading;

namespace Megawastu.Valas.KursProvider.Specs
{
    [TestFixture]
    public class When_excel_process_still_exist
    {
        [Test]
        public void Should_terminate_unclosed_excel()
        {
            ExcelKiller excelKiller = new ExcelKiller();
            ExcelKursReader reader = new ExcelKursReader();
            reader.Open();

            Process[] AllProcesses = Process.GetProcessesByName("excel");
            foreach (var item in AllProcesses)
            {
                Console.WriteLine(item.ProcessName);
                //item.Kill();
            }

            excelKiller.KillExcelProcessForThisApp();
            Thread.Sleep(2000);
            AllProcesses = Process.GetProcessesByName("excel");
            Assert.AreEqual(0, AllProcesses.Length);
        }
    }
}
