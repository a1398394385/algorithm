del .history\* /q /s

del directory.txt /q
dir /a:d /b | sort /r > "%cd%\directory.txt"
for /f "usebackq delims=" %%i in ("directory.txt") do (
    del "%%i\.history\*" /q /s
)
del directory.txt /q