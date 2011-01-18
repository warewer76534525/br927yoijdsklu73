@echo off
cls
tools\nant\NAnt.exe -buildfile:Megawastu.Valas.KursProvider.build %* -t:net-3.5 -D:external-bin=external-libs -D:tools=tools -D:build.base=build