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





