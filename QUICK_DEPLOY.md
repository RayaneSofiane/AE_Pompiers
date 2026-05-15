# 🚀 Quick Deployment Guide - Fire Station Manager

## Choose Your Deployment Method

### 1️⃣ **Heroku (5 minutes - Easiest)**
Perfect for: Quick prototyping, demo deployments

```bash
# Step 1: Install Heroku CLI
choco install heroku-cli  # Windows

# Step 2: Login
heroku login

# Step 3: Create app
heroku create fire-station-manager

# Step 4: Deploy
git push heroku master

# Step 5: Run migrations
heroku run php artisan migrate --seed

# Step 6: Open app
heroku open
```

**Cost**: Free tier available (limited)  
**Pros**: No server management, automatic HTTPS, simple  
**Cons**: Slow wake-up on free tier, limited resources

---

### 2️⃣ **DigitalOcean (10 minutes - Recommended)**
Perfect for: Production, small teams

```bash
# Step 1: Create droplet at digitalocean.com
# - Ubuntu 22.04 LTS, $6/month, 1GB RAM

# Step 2: SSH into server
ssh root@your_droplet_ip

# Step 3: Run initial setup
curl -fsSL https://raw.githubusercontent.com/your-repo/setup.sh | bash

# Step 4: Clone repo and deploy
cd /var/www
git clone https://github.com/your-repo/Pompiers.git
cd Pompiers
composer install --no-dev
php artisan migrate --seed
```

**Cost**: $6/month  
**Pros**: Full control, reliable, good performance  
**Cons**: Basic server admin knowledge needed

---

### 3️⃣ **Docker (10 minutes - Best for Scalability)**
Perfect for: Cloud deployments (AWS, Azure, GCP)

```bash
# Step 1: Build and run locally first
docker-compose up -d

# Step 2: Run migrations
docker-compose exec app php artisan migrate --seed

# Step 3: Access at localhost:8000

# Step 4: Deploy to cloud (Docker Hub, AWS ECR, etc.)
docker build -t your-repo/fire-station:latest .
docker push your-repo/fire-station:latest
```

**Cost**: Variable (depends on cloud provider)  
**Pros**: Portable, consistent across environments, scalable  
**Cons**: Docker learning curve

---

### 4️⃣ **Shared Hosting (15 minutes - Budget)**
Perfect for: Budget-conscious deployments

```bash
# Step 1: Upload files via FTP to public_html
# Using FileZilla or hosting control panel

# Step 2: Set permissions
chmod -R 755 bootstrap cache storage

# Step 3: Configure .env
cp .env.example .env
php artisan key:generate

# Step 4: Run migrations (via hosting control panel terminal)
php artisan migrate --seed
```

**Cost**: $3-10/month  
**Pros**: Affordable, no server management  
**Cons**: Limited performance, support quality varies

---

### 5️⃣ **Localhost/Development (Already ready!)**
Perfect for: Local testing

```bash
# The app is already configured for local development!

# Step 1: Install dependencies
composer install
npm install

# Step 2: Generate key
php artisan key:generate

# Step 3: Run migrations
php artisan migrate --seed

# Step 4: Start server
php artisan serve

# Step 5: Visit http://localhost:8000
```

---

## 🎯 Quick Comparison

| Platform | Time | Cost | Ease | Best For |
|----------|------|------|------|----------|
| **Heroku** | 5 min | Free | ⭐⭐⭐⭐⭐ | Prototypes |
| **DigitalOcean** | 10 min | $6/mo | ⭐⭐⭐⭐ | Production |
| **Docker** | 10 min | Variable | ⭐⭐⭐ | Cloud |
| **Shared Host** | 15 min | $3-10/mo | ⭐⭐⭐ | Budget |
| **Localhost** | 5 min | Free | ⭐⭐⭐⭐⭐ | Testing |

---

## 📋 Pre-Deployment Checklist

- [ ] Update `.env` with production settings
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Generate new `APP_KEY`
- [ ] Test locally: `php artisan serve`
- [ ] Verify all CRUD operations work
- [ ] Run `php artisan migrate --seed` in migration script
- [ ] Setup SSL certificate
- [ ] Configure database backup
- [ ] Test email configuration (if used)

---

## 📝 Environment Setup for Production

Create `.env` with these critical settings:

```env
APP_NAME=FireStationManager
APP_ENV=production
APP_KEY=base64:xxxxx
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=sqlite  # or mysql
DB_DATABASE=pompiers

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=warning

# Security
SESSION_SECURE_COOKIES=true
SESSION_HTTP_ONLY=true
```

---

## 🔒 Security Checklist

- [ ] Update all dependencies: `composer update`
- [ ] Use HTTPS everywhere
- [ ] Set secure headers
- [ ] Validate all user inputs
- [ ] Use Laravel's CSRF protection
- [ ] Keep secrets in `.env` (not git)
- [ ] Regular security audits: `composer audit`
- [ ] Monitor error logs daily
- [ ] Setup automated backups
- [ ] Use strong database passwords

---

## 🐛 Common Issues & Fixes

### "500 Internal Server Error"
```bash
# Check logs
tail -f storage/logs/laravel.log

# Verify permissions
chmod -R 775 storage bootstrap/cache

# Clear caches
php artisan cache:clear
php artisan config:clear
```

### "SQLSTATE[HY000]: General error"
```bash
# Database not found or connection error
# Verify DB_CONNECTION in .env
# Ensure database exists
# Run migrations: php artisan migrate
```

### "Class 'App\Models\FireStation' not found"
```bash
# Clear caches
composer dump-autoload
php artisan cache:clear
```

---

## 📞 Need Help?

1. **Check DEPLOYMENT.md** - Detailed guide for each platform
2. **Check logs** - `storage/logs/laravel.log`
3. **Run tests** - `php artisan tinker`
4. **Database issues** - Verify `.env` database settings
5. **Permission issues** - Check file/folder permissions

---

## ✅ Deployment Complete!

Once deployed:
1. Test app at your domain/URL
2. Verify all CRUD operations
3. Check error logs
4. Monitor performance
5. Setup automated backups
6. Enable monitoring/alerts

---

**Recommended Setup**: DigitalOcean $6/month droplet with SSL certificate for production use in Quebec.

For any questions, refer to the detailed DEPLOYMENT.md file!
