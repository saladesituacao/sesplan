FROM php:7.2.12-apache-stretch

# adiciona uma pasta para armazenar as sessions do php dentro de /var/lib/php e aplica permissões para o usuário do apache
RUN mkdir -p /var/lib/php/sessions 
RUN chown -R www-data:www-data /var/lib/php
RUN apt-get update
RUN apt-get install -y libpq-dev nano iputils-ping telnet
RUN docker-php-ext-install pgsql
RUN docker-php-ext-configure pgsql
RUN apt-get install -y libldb-dev libldap2-dev
RUN ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/local/lib/libldap.so
RUN ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so
RUN docker-php-ext-install ldap
RUN docker-php-ext-configure ldap
COPY . /var/www/html/sesplan
RUN chmod -R 755 /var/www/html
RUN rm -rf /var/lib/apt/lists/*
