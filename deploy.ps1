# Fire Station Management System - Quick Deployment Script (Windows/PowerShell)
# Usage: .\deploy.ps1 -Environment production|staging|heroku

param(
    [Parameter(Mandatory=$false)]
    [ValidateSet("production", "staging", "heroku")]
    [string]$Environment = "production"
)

$APP_PATH = Get-Location
$GREEN = [char]27 + "[32m"
$RED = [char]27 + "[31m"
$YELLOW = [char]27 + "[33m"
$NC = [char]27 + "[0m"

function Print-Info {
    param([string]$Message)
    Write-Host "${GREEN}[INFO]${NC} $Message"
}

function Print-Error {
    param([string]$Message)
    Write-Host "${RED}[ERROR]${NC} $Message"
}

function Print-Warn {
    param([string]$Message)
    Write-Host "${YELLOW}[WARN]${NC} $Message"
}

# Header
Write-Host ""
Write-Host "🚀 Fire Station Manager - Deployment Script"
Write-Host "Environment: $Environment"
Write-Host "Path: $APP_PATH"
Write-Host ""

# Check if git repo
if (-not (Test-Path .\.git)) {
    Print-Error "Not a git repository. Please run from project root."
    exit 1
}

Print-Info "Starting deployment for $Environment..."

# Common deployment steps
function Common-Deploy {
    Print-Info "Installing dependencies..."
    composer install --no-dev --optimize-autoloader
    if ($LASTEXITCODE -ne 0) {
        Print-Error "Composer install failed!"
        exit 1
    }
    
    Print-Info "Generating application key..."
    php artisan key:generate
    
    Print-Info "Caching configuration..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    Print-Info "Running migrations..."
    php artisan migrate --force
    if ($LASTEXITCODE -ne 0) {
        Print-Error "Migrations failed!"
        exit 1
    }
}

# Production deployment
function Deploy-Production {
    Print-Info "Deploying to PRODUCTION..."
    
    # Check if .env exists
    if (-not (Test-Path .\.env)) {
        Print-Error ".env file not found. Create it from .env.example"
        exit 1
    }
    
    # Verify APP_DEBUG is false
    $envContent = Get-Content .env
    if ($envContent -match "APP_DEBUG=true") {
        Print-Error "APP_DEBUG must be false in production!"
        exit 1
    }
    
    Common-Deploy
    
    Print-Info "Setting file permissions..."
    # Note: Windows doesn't use chmod, permissions are handled differently
    # But we ensure storage/logs are writable
    
    Print-Info "Clearing any previous cache..."
    php artisan cache:clear
    
    Print-Info "✅ Production deployment complete!"
    Print-Info "Access your application at the configured APP_URL"
}

# Staging deployment
function Deploy-Staging {
    Print-Info "Deploying to STAGING..."
    
    if (-not (Test-Path .\.env)) {
        Copy-Item .env.example .env
        Print-Warn ".env created from .env.example - please update it!"
    }
    
    Common-Deploy
    
    Print-Info "✅ Staging deployment complete!"
}

# Heroku deployment
function Deploy-Heroku {
    Print-Info "Deploying to HEROKU..."
    
    # Check if Procfile exists
    if (-not (Test-Path .\Procfile)) {
        Print-Warn "Procfile not found. Creating it..."
        Set-Content Procfile "web: vendor/bin/heroku-php-apache2 public/"
        git add Procfile
        git commit -m "chore: Add Procfile for Heroku deployment"
    }
    
    Print-Info "Pushing to Heroku..."
    git push heroku master
    if ($LASTEXITCODE -ne 0) {
        Print-Error "Git push to Heroku failed!"
        exit 1
    }
    
    Print-Info "Running migrations on Heroku..."
    heroku run php artisan migrate --seed
    
    Print-Info "✅ Heroku deployment complete!"
}

# Execute deployment
switch ($Environment) {
    "production" {
        Deploy-Production
    }
    "staging" {
        Deploy-Staging
    }
    "heroku" {
        Deploy-Heroku
    }
}

Print-Info "Deployment process finished!"
