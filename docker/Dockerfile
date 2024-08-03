FROM ubuntu:20.04

LABEL maintainer="Harrison Mattos"
ENV GIT_SSH_COMMAND "ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no"

# Habilita modo não interativo na instalação de pacotes
ENV DEBIAN_FRONTEND noninteractive

# Desabilita o cache do gerenciador de pacote
RUN echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache

# Atualiza o repositório de pacotes e o SO
RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get dist-upgrade -y && \
  apt-get autoremove -y

# Instala dependências
RUN apt-get install -y --no-install-recommends tzdata \
  locales \
  software-properties-common \
  curl \
  unzip \
  zip \
  pigz \
  vim \
  sqlite3 \
  wget \
  language-pack-gnome-pt \
  language-pack-pt-base \
  myspell-pt \
  myspell-pt-br \
  wbrazilian \
  wportuguese \
  ghostscript \
  git \
  gpg-agent \
  ssh \
  file \
  supervisor

# Instala repositório do PostgreSQL
RUN touch /etc/apt/sources.list.d/pgdg.list && \
  echo "deb http://apt.postgresql.org/pub/repos/apt/ focal-pgdg main" | tee /etc/apt/sources.list.d/pgdg.list && \
  wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add -

# Instala repositório PPA do PHP
RUN apt-add-repository -y ppa:ondrej/php

# Configura timezone do container para America/Sao_Paulo
ENV TZ America/Sao_Paulo
RUN echo $TZ > /etc/timezone && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  dpkg-reconfigure -f noninteractive tzdata

# Acerta codificação de ordenação do LATIN1
RUN sed -i "s|copy \"iso14651_t1\"|copy \"iso14651_t1\"\nreorder-after <U00A0>\n<U0020><CAP>;<CAP>;<CAP>;<U0020>\nreorder-end|" /usr/share/i18n/locales/pt_BR

# Regera o locales
RUN localedef -i pt_BR -c -f ISO-8859-1 -A /usr/share/locale/locale.alias pt_BR && \
  locale-gen pt_BR && \
  echo "locales locales/default_environment_locale select pt_BR.UTF-8" | debconf-set-selections && \
  dpkg-reconfigure --frontend noninteractive locales

# Atualiza lista de repositórios
RUN apt-get update

# Aceita os termos EULA para o pacote MS fonts e instala as fontes
RUN echo ttf-mscorefonts-installer msttcorefonts/accepted-mscorefonts-eula select true | debconf-set-selections && \
  apt-get install -y --no-install-recommends ttf-mscorefonts-installer

# Instala o cliente psql
RUN apt-get install -y --no-install-recommends postgresql-client-11

# Instala o libreoffice
RUN apt-get install -y --no-install-recommends libreoffice-writer

# Instala pacotes necessários para as aplicações
RUN apt-get install -y --no-install-recommends \
  apache2 \
  php8.1 \
  php8.1-bcmath \
  php8.1-bz2 \
  php8.1-cli \
  php8.1-common \
  php8.1-curl \
  php8.1-gd \
  php8.1-imagick \
  php8.1-interbase \
  php8.1-mbstring \
  php8.1-pgsql \
  php8.1-soap \
  php8.1-sqlite3 \
  php8.1-xml \
  php8.1-xmlrpc \
  php8.1-zip \
  php8.1-intl \
  php8.1-opcache \
  php8.1-readline \
  php8.1-fpm \
  php8.1-xdebug \
  php8.1-ldap \
  php8.1-ast \
  php8.1-dev \
  php-pear

# Habilita o xdebug
RUN echo "xdebug.remote_enable=on" >> /etc/php/8.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /etc/php/8.1/mods-available/xdebug.ini

# Ajusta a permissão do imagick
RUN sed -i "s|<policy domain=\"coder\" rights=\"none\" pattern=\"PDF\" />|<policy domain=\"coder\" rights=\"read\|write\" pattern=\"PDF\" />|" /etc/ImageMagick-6/policy.xml

# Ajusta o fpm
RUN sed -i "s|^pm\ =.*|pm = ondemand|" /etc/php/8.1/fpm/pool.d/www.conf && \
  sed -i "s|^pm.max_children.*|pm.max_children = 300|" /etc/php/8.1/fpm/pool.d/www.conf && \
  sed -i "s|^pm.process_idle_timeout.*|pm.process_idle_timeout = 60s|" /etc/php/8.1/fpm/pool.d/www.conf && \
  sed -i "s|^pm.max_requests.*|pm.max_requests = 500|" /etc/php/8.1/fpm/pool.d/www.conf

# Ajusta o apache
RUN sed -i "s|^MaxRequestWorkers.*|MaxRequestWorkers         350|" /etc/apache2/mods-available/mpm_event.conf
RUN echo "umask 002" >> /etc/apache2/envvars

# Instala o composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
  php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
  rm composer-setup.php

# Instala o npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
  apt-get install -y gcc g++ make nodejs

# Exporta variável que permite a execução do composer como root sem emitir avisos
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

# Cria o vhost com os parâmetros necessários para o e-cidade, e-cidadeonline, transparência e portal do aluno.
RUN a2enmod rewrite ssl proxy_fcgi setenvif && \
  a2enconf php8.1-fpm && \
  a2disconf serve-cgi-bin && \
  a2dissite 000-default.conf && \
  a2enmod proxy rewrite ssl proxy_html proxy_http proxy_connect

# Adiciona vhosts
ADD config/apache/laravel.conf /etc/apache2/sites-available/

# Configura o php.ini redirecionando a saída de erro para a saída padrão
RUN ln -s /dev/stderr /var/log/php_errors.log && \
  chown www-data. /var/log/php_errors.log && \
  sed -i 's|^short_open_tag = .*|short_open_tag = On|g' /etc/php/8.1/fpm/php.ini && \
  sed -i 's|^session.gc_maxlifetime = .*|session.gc_maxlifetime = 7200|g' /etc/php/8.1/fpm/php.ini && \
  sed -i 's|^;date.timezone =.*|date.timezone = "America/Sao_Paulo"|g' /etc/php/8.1/fpm/php.ini && \
  sed -i 's|^;error_log.*|error_log = /var/log/php_errors.log|g' /etc/php/8.1/fpm/php.ini && \
  sed -i 's|^short_open_tag = .*|short_open_tag = On|g' /etc/php/8.1/cli/php.ini && \
  sed -i 's|^session.gc_maxlifetime = .*|session.gc_maxlifetime = 7200|g' /etc/php/8.1/cli/php.ini && \
  sed -i 's|^;date.timezone =.*|date.timezone = "America/Sao_Paulo"|g' /etc/php/8.1/cli/php.ini && \
  sed -i 's|^;error_log.*|error_log = /var/log/php_errors.log|g' /etc/php/8.1/cli/php.ini

# Instala o dockerize
#ENV DOCKERIZE_VERSION v0.6.1
#RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
#    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
#    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Supervisor
RUN mkdir -p /run/php/
COPY config/supervisord/supervisord.conf /etc/supervisor/supervisord.conf
COPY config/supervisord/conf.d/ /etc/supervisor/conf.d/

# Dependência da API de dados que é alternativa para o PHP-FPM
# Instala swoole
# RUN printf "\n" | pecl install swoole
# Habilita o swoole
# RUN echo "extension=swoole.so" >> /etc/php/8.1/fpm/conf.d/20-swoole.ini

# RUN useradd -d /home/dbseller -g www-data -G sudo,adm,cdrom,dip,plugdev -k /etc/skel -m -s /bin/bash dbseller

# Limpa os temporários
RUN apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*

# Startup script to change uid/gid (if environment variable passed) and start supervisord in foreground
COPY ./scripts/start.sh /start.sh
RUN chmod 755 /start.sh

EXPOSE 80

WORKDIR /var/www/html

CMD ["/bin/bash", "/start.sh"]
