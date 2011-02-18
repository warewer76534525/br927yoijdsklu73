rmdir /s /q installer\bin
mkdir installer\bin
mkdir installer\bin\megawastu
cd Megawastu.Valas.RateFeeder
copy database ..\installer\sql
call build.bat create.installer
