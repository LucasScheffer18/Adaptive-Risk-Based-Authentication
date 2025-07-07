FROM php:8.2-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões do PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql zip

# Ativa módulos do Apache
RUN a2enmod rewrite
RUN a2enmod headers

# Configura o Apache
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf \
    && echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '    Require all granted' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

# Configura o DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|g' /etc/apache2/sites-available/000-default.conf

# Copia todo o conteúdo da pasta atual para o Apache
COPY . /var/www/html/

# Cria um arquivo index.php básico se não existir
RUN if [ ! -f /var/www/html/index.php ]; then \
        echo '<?php phpinfo(); ?>' > /var/www/html/index.php; \
    fi

# Permissão dos arquivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Define o diretório de trabalho
WORKDIR /var/www/html

# Expõe a porta 80
EXPOSE 80