# config.nice

```bash
#! /bin/sh
#
# Created by configure
'./configure' \
'--prefix=/usr/local/php56' \
'--with-config-file-path=/usr/local/php56/etc' \
'--with-mysql=mysqlnd' \
'--with-pdo-mysql=mysqlnd' \
'--with-mysqli=mysqlnd' \
'--enable-fpm' \
'--enable-bcmath' \
'--with-curl' \
'--enable-mysqlnd' \
'--enable-mbstring' \
'--enable-opcache' \
"$@"
```