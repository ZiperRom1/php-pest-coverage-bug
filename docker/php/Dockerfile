FROM php:8.1-alpine

ENV DEBIAN_FRONTEND noninteractive

# Setup server timezone
RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

# Install dev tools
RUN apk add --update bash bash-completion

# Configure bash completion
RUN mkdir /etc/bash_completion.d

SHELL ["/bin/bash", "-c"]

# Use docker-php-entension-installer to install composer and xdebug https://github.com/mlocati/docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install PHP Composer and xdebug
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer xdebug

# Setup PHP Xdebug configuration https://www.jetbrains.com/help/phpstorm/configuring-xdebug.html#configuring-xdebug-docker
RUN echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /app

# Install Composer deps
ADD . /app
RUN composer install

# Add bash auto completion for app cli
RUN ./app completion bash > /etc/bash_completion.d/symphony.sh
