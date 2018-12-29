# 静态ip 配置

## 配置文件 
 /etc/network/interfaces

## 内容
auto lo  
iface lo inet loopback  
auto enp0s3  
iface enp0s3 inet static  
address 192.168.199.250  
gateway 192.168.199.1  
netmask 255.255.255.0  
network 192.168.199.0  
broadcast 192.168.199.255  

# dns 配置
cat /etc/resolvconf/resolv.conf.d/base  
nameserver 223.5.5.5  
nameserver 114.114.114.114  
