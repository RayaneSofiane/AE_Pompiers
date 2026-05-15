#!/bin/bash

# Fire Station Management System - Quick Deployment Script
# Usage: ./deploy.sh production|staging|heroku

ENVIRONMENT=${1:-production}
APP_PATH=$(cd "$(dirname "$0")" && pwd)

echo "🚀 Fire Station Manager - Deployment Script"
echo "Environment: $ENVIRONMENT"
echo "Path: $APP_PATH"
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_info() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_warn() {
    echo -e "${YELLOW}[WARN]${NC} $1"
}

# Check if we're in git repo
if [ ! -d .git ]; then
    print_error "Not a git repository. Please run from project root."
    exit 1
fi

print_info "Starting deployment for $ENVIRONMENT..."

# Common deployment steps
common_deploy() {
    print_info "Installing dependencies..."
    composer install --no-dev --optimize-autoloader
    
    print_info "Generating application key..."
    php artisan key:generate
    
    print_info "Caching configuration..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    print_info "Running migrations..."
    php artisan migrate --force
}

# Production deployment
deploy_production() {
    print_info "Deploying to PRODUCTION..."
    
    # Check if .env exists
    if [ ! -f .env ]; then
        print_error ".env file not found. Create it from .env.example"
        exit 1
    fi
    
    # Verify APP_DEBUG is false
    if grep -q "APP_DEBUG=true" .env; then
        print_error "APP_DEBUG must be false in production!"
        exit 1
    fi
    
    common_deploy
    
    print_info "Setting file permissions..."
    chmod -R 755 bootstrap cache storage
    chmod -R 775 bootstrap/cache storage
    
    print_info "Clearing any previous cache..."
    php artisan cache:clear
    
    print_info "✅ Production deployment complete!"
    print_info "Access your application at the configured APP_URL"
}

# Staging deployment
deploy_staging() {
    print_info "Deploying to STAGING..."
    
    if [ ! -f .env ]; then
        cp .env.example .env
        print_warn ".env created from .env.example - please update it!"
    fi
    
    common_deploy
    
    print_info "✅ Staging deployment complete!"
}

# Heroku deployment
deploy_heroku() {
    print_info "Deploying to HEROKU..."
    
    # Check if Procfile exists
    if [ ! -f Procfile ]; then
        print_warn "Procfile not found. Creating it..."
        echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
        git add Procfile
        git commit -m "chore: Add Procfile for Heroku deployment"
    fi
    
    print_info "Pushing to Heroku..."
    git push heroku master
    
    print_info "Running migrations on Heroku..."
    heroku run php artisan migrate --seed
    
    print_info "✅ Heroku deployment complete!"
}

# Execute deployment based on environment
case $ENVIRONMENT in
    production)
        deploy_production
        ;;
    staging)
        deploy_staging
        ;;
    heroku)
        deploy_heroku
        ;;
    *)
        print_error "Unknown environment: $ENVIRONMENT"
        echo "Usage: ./deploy.sh [production|staging|heroku]"
        exit 1
        ;;
esac

print_info "Deployment process finished!"
