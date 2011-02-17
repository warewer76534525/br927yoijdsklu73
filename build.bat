rmdir /s /q installer\bin
mkdir installer\bin
cd Megawastu.Valas.RateFeeder
call build.bat create.installer
cd ..\Megawastu.Valas.KursProvider
call build.bat create.installer
