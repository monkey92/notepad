
#查看被删除但是还被进程使用的文件
lsof | grep deleted

#查看端口占用
lsof -i:3306
