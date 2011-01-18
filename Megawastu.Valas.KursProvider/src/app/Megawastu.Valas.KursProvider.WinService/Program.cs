using Megawastu.Valas.KursProvider.Application;

namespace Megawastu.Valas.KursProvider.WinService
{
    class Program
    {
        static void Main(string[] args)
        {
            KursExcelProvider kursExcelProvider = new KursExcelProvider();
            kursExcelProvider.Start();
        }
    }
}
