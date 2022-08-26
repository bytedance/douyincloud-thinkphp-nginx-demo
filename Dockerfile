FROM public-cn-beijing.cr.volces.com/public/base:php-7.4-fpm-nginx

WORKDIR /opt/application

COPY . /opt/application

# 容器中fpm的9000端口被占用，因此需要替换端口
RUN cp /opt/application/conf/nginx.conf /etc/nginx/conf.d/default.conf \
    && cp /opt/application/conf/www.conf /usr/local/etc/php-fpm.d/www.conf \
    && cp /opt/application/conf/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf\
    && mkdir -p /run/nginx \
    && chmod -R 777 /opt/application/runtime \
    && chmod -R 777 /opt/application/run.sh


EXPOSE 8000
#
CMD /opt/application/run.sh