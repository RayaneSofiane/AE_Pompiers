# Fire Station Management System - Deployment Guide

## Deployment Options

### Option 1: Heroku (Easiest - Free tier available)
### Option 2: DigitalOcean (Recommended - $6/month)
### Option 3: Shared Hosting (Bluehost, GoDaddy, etc.)
### Option 4: AWS/Azure (Enterprise)
### Option 5: Localhost/Laragon (Development)

---

## Option 1: Deploy to Heroku (Recommended for Quick Start)

### Prerequisites
- Heroku account (free tier available)
- Heroku CLI installed
- Git installed

### Step 1: Install Heroku CLI
```bash
# Download from https://devcenter.heroku.com/articles/heroku-cli
# Or use Windows package manager
choco install heroku-cli
```

### Step 2: Login to Heroku
```bash
heroku login
```

### Step 3: Create Heroku App
```bash
cd c:\laragon\www\Pompiers
heroku create fire-station-manager
```

### Step 4: Add Buildpacks
```bash
heroku buildpacks:add --index 1 heroku/php
heroku buildpacks:add --index 2 heroku/nodejs
```

### Step 5: Configure Environment Variables
```bash
heroku config:set APP_NAME=FireStationManager
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_URL=https://your-app-name.herokuapp.com
heroku config:set LOG_CHANNEL=single
heroku config:set DB_CONNECTION=sqlite
```

### Step 6: Create Procfile
```bash
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
```

### Step 7: Deploy
```bash
git push heroku master
heroku run php artisan migrate --seed
heroku open
```

---

## Option 2: Deploy to DigitalOcean (Recommended for Production)

### Prerequisites
- DigitalOcean account ($6/month basic droplet)
- SSH client
- Domain name (optional)

### Step 1: Create Droplet
1. Go to DigitalOcean console
2. Click "Create" → "Droplets"
3. Select:
   - Image: Ubuntu 22.04 LTS
   - Size: $6/month (1GB RAM, 1 CPU, 25GB SSD)
   - Datacenter: Choose nearest location
   - Authentication: SSH key or password
4. Click "Create Droplet"

### Step 2: Connect to Droplet
```bash
ssh root@your_droplet_ip
```

### Step 3: Install Dependencies
```bash
# Update system
apt update && apt upgrade -y

# Install PHP and extensions
apt install -y php-fpm php-cli php-mysql php-sqlite3 php-xml php-mbstring php-bcmath php-curl composer

# Install Nginx
apt install -y nginx

# Install Git
apt install -y git

# Install Node.js (optional, for asset building)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
apt install -y nodejs
```

### Step 4: Configure Web Server
```bash
# Create Nginx config
cat > /etc/nginx/sites-available/fire-station << 'EOF'
server {
    listen 80;
    server_name your_domain.com;
    root /var/www/Pompiers/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
    }
}
EOF

# Enable site
ln -s /etc/nginx/sites-available/fire-station /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default

# Test and restart Nginx
nginx -t
systemctl restart nginx
```

### Step 5: Clone and Setup Application
```bash
cd /var/www
git clone https://github.com/your-repo/Pompiers.git
cd Pompiers

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Setup environment
cp .env.example .env
php artisan key:generate

# Set permissions
chown -R www-data:www-data /var/www/Pompiers
chmod -R 755 /var/www/Pompiers
chmod -R 775 /var/www/Pompiers/storage /var/www/Pompiers/bootstrap/cache
```

### Step 6: Database Setup
```bash
# For SQLite
touch /var/www/Pompiers/database/database.sqlite

# For MySQL (alternative)
apt install -y mysql-server
mysql -e "CREATE DATABASE pompiers;"
mysql -e "CREATE USER 'pompiers'@'localhost' IDENTIFIED BY 'password';"
mysql -e "GRANT ALL PRIVILEGES ON pompiers.* TO 'pompiers'@'localhost';"
```

### Step 7: Update .env for Production
```bash
cat > /var/www/Pompiers/.env << 'EOF'
APP_NAME=FireStationManager
APP_ENV=production
APP_KEY=base64:your_key_here
APP_DEBUG=false
APP_URL=https://your_domain.com

DB_CONNECTION=sqlite
LOG_CHANNEL=single
LOG_LEVEL=warning
EOF
```

### Step 8: Run Migrations
```bash
cd /var/www/Pompiers
php artisan migrate --seed
```

### Step 9: Setup SSL (Let's Encrypt)
```bash
apt install -y certbot python3-certbot-nginx
certbot --nginx -d your_domain.com
```

---

## Option 3: Shared Hosting Deployment

### Prerequisites
- FTP/SFTP access to hosting
- SSH access (if available)
- PHP 8.2+ with required extensions
- MySQL or SQLite database

### Step 1: Upload Files via FTP
1. Connect to hosting via FTP client (FileZilla)
2. Upload all files to `public_html` or `www` directory
3. Ensure `public` folder contents are in web root

### Step 2: Configure Environment
```bash
# Via SSH or hosting file manager
cp .env.example .env
php artisan key:generate
```

### Step 3: Set Permissions
```bash
chmod -R 755 bootstrap cache storage
chmod 644 .env
```

### Step 4: Run Migrations
```bash
php artisan migrate --seed
```

### Step 5: Update .env
```
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite (or mysql)
MAIL_MAILER=smtp
```

---

## Option 4: Docker Deployment

### Step 1: Create Dockerfile
```dockerfile
FROM php:8.2-fpm

# Install extensions
RUN docker-php-ext-install pdo pdo_sqlite bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install --no-dev && \
    php artisan key:generate && \
    chmod -R 775 storage bootstrap/cache
```

### Step 2: Create docker-compose.yml
```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "8000:8000"
    environment:
      APP_ENV: production
      DB_CONNECTION: sqlite
    volumes:
      - .:/var/www
    command: php artisan serve --host=0.0.0.0
```

### Step 3: Deploy
```bash
docker-compose up -d
```

---

## Development to Production Checklist

### Before Deployment
- [ ] Update `.env` for production
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Generate `APP_KEY`
- [ ] Configure database connection
- [ ] Set up SSL certificate
- [ ] Test all CRUD operations locally
- [ ] Run migrations and seed data
- [ ] Test on staging server first

### Security
- [ ] Use environment variables for secrets
- [ ] Enable HTTPS only
- [ ] Set secure headers
- [ ] Configure CORS if needed
- [ ] Validate all user inputs
- [ ] Use Laravel's built-in CSRF protection

### Performance
- [ ] Run `composer install --no-dev`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Enable OPcache in PHP
- [ ] Set up proper logging
- [ ] Monitor error logs

### Database
- [ ] Create database backups
- [ ] Test migrations on production
- [ ] Set up database backups schedule
- [ ] Monitor database performance

---

## Deployment Commands Summary

### Production Build
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate optimized configs
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Seed database (first time only)
php artisan db:seed
```

### Setting Up SSL
```bash
# Using Let's Encrypt (Certbot)
sudo certbot certonly --standalone -d your-domain.com

# Or with nginx
sudo certbot --nginx -d your-domain.com
```

### Monitoring
```bash
# View logs
tail -f storage/logs/laravel.log

# Check disk space
df -h

# Check memory usage
free -m

# Monitor processes
top
```

---

## Post-Deployment

### 1. Database Backup Strategy
```bash
# Automated daily backup
0 2 * * * cd /var/www/Pompiers && php artisan backup:run
```

### 2. Update Strategy
```bash
# Pull latest code
git pull origin master

# Run migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:cache

# Restart services
systemctl restart php-fpm
systemctl restart nginx
```

### 3. Monitoring & Logs
```bash
# Setup log rotation
cat > /etc/logrotate.d/pompiers << 'EOF'
/var/www/Pompiers/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
}
EOF
```

---

## Troubleshooting

### 502 Bad Gateway
```bash
# Check PHP-FPM status
systemctl status php-fpm

# Check Nginx logs
tail -f /var/log/nginx/error.log
```

### Database Connection Error
```bash
# Verify DB connection in .env
php artisan tinker
>>> DB::connection()->getPdo();
```

### Permission Denied
```bash
# Fix ownership
chown -R www-data:www-data /var/www/Pompiers

# Fix permissions
chmod -R 755 bootstrap cache storage
```

### Slow Performance
```bash
# Check logs for slow queries
php artisan tinker
>>> DB::enableQueryLog();
>>> FireStation::all();
>>> dd(DB::getQueryLog());
```

---

## Environment Variables Reference

```env
# Application
APP_NAME=FireStationManager
APP_ENV=production
APP_KEY=base64:xxxxx
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=sqlite OR mysql
DB_DATABASE=pompiers
DB_USERNAME=user
DB_PASSWORD=password

# Mail (if needed)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxx
MAIL_PASSWORD=xxx

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=warning
```

---

## Quick Start Deployment (5 minutes)

### Using Heroku (Easiest)
```bash
# 1. Create Procfile
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile

# 2. Deploy
heroku create fire-station-manager
git push heroku master

# 3. Run migrations
heroku run php artisan migrate --seed

# 4. Open app
heroku open
```

### Using Docker
```bash
# 1. Build and run
docker-compose up -d

# 2. Run migrations
docker-compose exec web php artisan migrate --seed

# 3. Access at localhost:8000
```

---

**Choose Heroku for simplicity, DigitalOcean for reliability and cost, or Docker for scalability.**

For production Quebec deployment, DigitalOcean is recommended: affordable ($6/month), reliable, and full control over your infrastructure.
