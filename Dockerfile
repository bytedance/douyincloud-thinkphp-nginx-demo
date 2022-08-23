FROM public-cn-beijing.cr.volces.com/public/base:php-7.4-fpm

RUN apt-get -y update && apt-get -y install nginx

# mongodb扩展依赖ssl
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev

RUN pecl update-channels \
    && pecl install redis \
	&& pecl install mongodb \
    && docker-php-ext-enable redis mongodb

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

WORKDIR /app
# 将当前目录（dockerfile所在目录）下所有文件都拷贝到工作目录下（.dockerignore中文件除外）
# verdor如过大，则不建议打包verdor，而是在docker中重新拉取依赖。
COPY . /app/
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN cp /app/conf/nginx.conf /etc/nginx/conf.d/default.conf \
    && cp /app/conf/www.conf /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /run/nginx \
    && chmod -R 777 /app/runtime \
    && chmod -R 777 /app/run.sh

EXPOSE 8000

CMD ["sh", "run.sh"]