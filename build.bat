rmdir /s /q installer\bin
mkdir installer\bin
mkdir installer\bin\megawastu
cd Megawastu.Valas.RateFeeder
copy database ..\installer\sql
call build.bat create.installer
cd ..\Megawastu.Valas.KursProvider
call build.bat create.installer
cd ..\Megawastu.Valas.WebApp
xcopy /E src ..\installer\bin\megawastu
copy sql ..\installer\sql
