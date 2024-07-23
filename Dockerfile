# Базовый образ Ubuntu
FROM ubuntu:20.04

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-mysql \
    mysql-server \
    phpmyadmin \
    mc \
    openssh-server \
    curl \
    git \
    unzip

# Настройка SSH
RUN useradd -m admin && echo "admin:trust" | chpasswd && \
    mkdir /var/run/sshd && \
    sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config

# Настройка Apache
COPY apache-config/bookshop.conf /etc/apache2/sites-available/bookshop.conf
RUN a2ensite bookshop.conf && a2enmod rewrite

# Копирование проекта
COPY src /var/www/bookshop

# Установка прав доступа
RUN chown -R www-data:www-data /var/www/bookshop

# Запуск Apache и SSH
CMD service apache2 start && service ssh start && tail -f /dev/null
