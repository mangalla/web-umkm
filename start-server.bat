@echo off
REM Menjalankan server lokal untuk Web1, Web2, dan Panel Admin.
cd /d "%~dp0"
echo Panel admin : http://localhost:8000/admin/
echo Web 1       : http://localhost:8000/Web1/
echo Web 2       : http://localhost:8000/Web2/
echo Tekan Ctrl+C untuk berhenti.
start "" http://localhost:8000/admin/
php -S localhost:8000
