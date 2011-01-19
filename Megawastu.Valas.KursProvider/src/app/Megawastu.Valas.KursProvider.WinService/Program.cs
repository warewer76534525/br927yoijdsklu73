using Megawastu.Valas.KursProvider.Application;
using System;

namespace Megawastu.Valas.KursProvider.WinService
{
    class Program
    {
        [STAThread]
        static void Main(string[] args)
        {
            KursExcelProvider kursExcelProvider = new KursExcelProvider();  
            kursExcelProvider.Start();
        }
    }
}
