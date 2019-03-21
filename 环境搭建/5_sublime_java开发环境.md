# 构建文件

```sh
# javaC.sublime-build
{
	"cmd": ["runJava.bat", "$file"],
	"file_regex": "^(...*?):([0-9]*):?([0-9]*)",
	"selector": "source.java",
	"encoding": "gbk"
}
```

# 运行脚本

```sh
@ECHO OFF
cd %~dp1
ECHO Compiling %~nx1.......
IF EXIST %~n1.class (
DEL %~n1.class
)
javac -encoding utf8 %~nx1
IF EXIST %~n1.class (
ECHO -----------OUTPUT-----------
java %~n1
)
pause && exit

```

