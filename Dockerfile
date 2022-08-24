FROM public-cn-beijing.cr.volces.com/public/base:php-7.4-fpm-nginx

WORKDIR /opt/application
# 将当前目录（dockerfile所在目录）下所有文件都拷贝到工作目录下（.dockerignore中文件除外）
# verdor如过大，则不建议打包verdor，而是在docker中重新拉取依赖。
COPY . /opt/application

RUN cp /opt/application/conf/nginx.conf /etc/nginx/conf.d/default.conf \
    && cp /opt/application/conf/www.conf /usr/local/etc/php-fpm.d/www.conf \
    && cp /opt/application/conf/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf\
    && mkdir -p /run/nginx \
    && chmod -R 777 /opt/application/runtime \
    && chmod -R 777 /opt/application/run.sh


EXPOSE 8000
#
CMD /opt/application/run.sh