FROM php:7.2-apache
MAINTAINER Thiago Rente <thiagosilvarente@gmail.com>
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
EXPOSE 80
