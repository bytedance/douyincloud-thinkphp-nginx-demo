#!/bin/sh

# 后台启动
php-fpm -D
if [$? -ne 0]; then
  echo "fpm init failed"
fi


# 关闭后台启动，hold住进程
nginx -g 'daemon off;'