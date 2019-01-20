# docker免sudo

## 把当前用户加入到 docker组
sudo gpasswd -a ddc docker

## 重启docker
sudo service docker restart  

## 当前用户登录到docker用户组  
newgrp - docker 


# 拉取镜像
docker pull centos:7

# 运行镜像 

docker run -it --rm --name ddc-test  centos:7

# 列出容器

docker container ls --all

# 删除容器
docker container rm {$container_id}

# 理解
一个容器一个服务 （nginx 一个服务 php-fpm一个服务 redis一个服务）

# run例子

```sh
docker run --name my-php-fpm -d \
	-v /home/ddc/ws/docker-demo/server.conf/php:/ddc-php-conf \
	-v /home/ddc/ws/docker-demo/app:/ddc-app \
	sodisnai/php-dev:3 \
	/usr/sbin/php-fpm  -c /ddc-php-conf/php.ini  -y /ddc-php-conf/php-fpm.conf

docker run --name my-nginx -d -p 80:80 \
	-v /home/ddc/ws/docker-demo/server.conf/nginx:/etc/nginx/conf.d \
       	-v /home/ddc/ws/docker-demo/app:/ddc-app \
	--link my-php-fpm:my-php-fpm \
	sodisnai/php-dev:3 \
	/usr/sbin/nginx -g 'daemon off;'
```





