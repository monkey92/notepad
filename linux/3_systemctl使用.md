# 查看一个服务的状态
systemctl status  nginx

# 开启一个服务开机启动
systemctl enable nginx

```txt
## 执行systemctl enable nginx 的输出信息
Created symlink from /etc/systemd/system/multi-user.target.wants/nginx.service to /usr/lib/systemd/system/nginx.service.
```

# 禁用一个服务
systemctl disable nginx