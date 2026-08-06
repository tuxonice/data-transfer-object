ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-cli-alpine

# Match the host user so vendor/, coverage/ and the classes the test suite
# generates into tests/Generated/ stay owned by the developer, not root.
ARG UID=1001
ARG GID=1001

# PCOV provides code coverage. The build toolchain is added and removed in the
# same layer so it is not part of the final image.
RUN apk add --no-cache git unzip \
    && apk add --no-cache --virtual .build-deps ${PHPIZE_DEPS} \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && apk del .build-deps

# Instrument the library source only, not vendor/ or tests/.
RUN printf 'pcov.directory=/app/src\n' > /usr/local/etc/php/conf.d/pcov.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN addgroup -g ${GID} app \
    && adduser -u ${UID} -G app -s /bin/sh -D app

USER app

WORKDIR /app