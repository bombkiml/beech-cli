@echo off

@setlocal

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" ".\\vendor\beech-cli\src\beechcli.php" %*

@endlocal
