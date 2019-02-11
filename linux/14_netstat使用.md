# tips


-l  (listen) 仅列出 Listen (监听) 的服务
-t  (tcp) 仅显示tcp相关内容
-n (numeric) 直接显示ip地址以及端口，不解析为服务名或者主机名
-p (pid) 显示出socket所属的进程PID 以及进程名字
--inet 显示ipv4相关协议的监听

```bash
sudo netstat  -lntp
```



