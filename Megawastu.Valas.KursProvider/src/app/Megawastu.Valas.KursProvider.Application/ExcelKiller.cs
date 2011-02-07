
using System.Diagnostics;
using System.Linq;
using System.Collections.Generic;
namespace Megawastu.Valas.KursProvider.Application
{
    public class ExcelKiller
    {
        private IList<long> _alreadyRunningExcel = new List<long>();

        public ExcelKiller()
        {
            RegisterAlreadyRunningExcel();
        }

        private void RegisterAlreadyRunningExcel()
        {
            Process[] AllProcesses = Process.GetProcessesByName("excel");
            foreach (var item in AllProcesses)
            {
                _alreadyRunningExcel.Add(item.Id);
            }
        }

        public void KillExcelProcessForThisApp()
        {
            Process.GetProcessesByName("excel").Where(x => !_alreadyRunningExcel.Contains(x.Id)).ToList().ForEach(x => x.Kill());
        }
    }
}
