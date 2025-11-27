FROM php:8.3-cli-alpine AS builder
RUN apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pdo_mysql \
    && apk del $PHPIZE_DEPS

WORKDIR /var/www/html
COPY app/ .

FROM php:8.3-fpm-alpine
COPY --from=builder /var/www/html /var/www/html
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

RUN rm -rf /var/cache/apk* /tmp/*

WORKDIR /var/www/html
EXPOSE 9000
CMD ["php-fpm"]