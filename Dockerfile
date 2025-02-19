FROM php:8.1-fpm

# Set DEBIAN_FRONTEND to avoid interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# Set working directory
WORKDIR /var/www

# Install required dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Clone the common utility folder from the GitHub repository
RUN git clone https://github.com/kena2018/cosmicerp.git /var/www/cosmic

# Copy application files to the container
COPY . /var/www

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www

# Set the working directory to the application folder
WORKDIR /var/www/cosmicerp/app

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies if composer.json is present
RUN if [ -f "composer.json" ]; then composer install --no-dev --optimize-autoloader; fi

# Copy the default Nginx configuration file
COPY docker_files/docker_files/nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose necessary ports
EXPOSE 80 9000
EXPOSE 9100

# Define environment variable
ENV NAME cosprothirteen

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "nginx -g 'daemon off;' & php-fpm"]
