# Fire Station Management System - Quebec

## Project Overview
This is a Laravel-based web application for managing fire station activities across Quebec. The system provides complete CRUD functionality for managing fire stations and their operational states.

## Features

### ✓ List Fire Stations
Display all registered fire stations with their complete information including name, address, city, phone number, and state.
- Route: `GET /fireStations`
- View: `resources/views/fireStation.blade.php`
- Controller: `FireStationController@index()`

### ✓ Add Fire Station
Create new fire station entries in the system with validation of all required fields.
- Route: `POST /fireStations/add`
- Controller: `FireStationController@add()`
- Validations:
  - Name: required, string, max 100 characters
  - Address: required, string, max 200 characters
  - City: required, string, max 100 characters
  - Phone: required, string, max 12 characters
  - State: required, must exist in states table

### ✓ Modify Fire Station
Update existing fire station information through a dedicated edit form.
- Routes: 
  - `GET /fireStations/{id}/edit` - Display edit form
  - `PUT /fireStations/{id}/update` - Process update
- Controller: 
  - `FireStationController@formModifyFireStation()`
  - `FireStationController@update()`
- View: `resources/views/fireStationModify.blade.php`

### ✓ Delete Fire Station
Remove individual fire stations from the system.
- Route: `DELETE /fireStations/{id}/delete`
- Controller: `FireStationController@delete()`

### ✓ Clear List
Remove all fire stations at once with confirmation.
- Route: `DELETE /fireStations/clear`
- Controller: `FireStationController@clear()`

## Technology Stack
- **Framework**: Laravel 11
- **Database**: MySQL/SQLite
- **Frontend**: Blade Templates + Tailwind CSS
- **Version Control**: Git

## Database Schema

### States Table
```
id: unsigned big integer (primary key)
description: varchar(100)
```

### Fire Stations Table
```
id: unsigned big integer (primary key)
name: varchar(100)
address: varchar(200)
city: varchar(100)
phone: varchar(12)
id_state: unsigned big integer (foreign key -> states.id)
```

## Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Laravel 11
- MySQL or SQLite

### Steps

1. **Clone or navigate to project**
   ```bash
   cd c:/laragon/www/Pompiers
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start development server**
   ```bash
   php artisan serve
   ```

6. **Build assets (optional)**
   ```bash
   npm run dev
   ```

## File Structure

```
Pompiers/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── FireStationController.php
│   └── Models/
│       ├── FireStation.php
│       └── State.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000003_create_states_table.php
│   │   └── 2024_01_01_000004_create_fire_stations_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── app.blade.php
│       ├── fireStation.blade.php
│       ├── fireStationModify.blade.php
│       └── navbar.blade.php
├── routes/
│   └── web.php
└── README.md
```

## Models & Relationships

### State Model
```php
namespace App\Models;

class State extends Model {
    public $timestamps = false;
    protected $fillable = ['description'];
    
    public function fireStations() {
        return $this->hasMany(FireStation::class, 'id_state');
    }
}
```

### FireStation Model
```php
namespace App\Models;

class FireStation extends Model {
    public $timestamps = false;
    protected $fillable = ['name', 'address', 'city', 'phone', 'id_state'];
    
    public function state() {
        return $this->belongsTo(State::class, 'id_state');
    }
}
```

## API Routes

| Method | Route | Controller Method | Description |
|--------|-------|------------------|-------------|
| GET | `/` | `FireStationController@index()` | Home - List fire stations |
| GET | `/fireStations` | `FireStationController@index()` | List all fire stations |
| POST | `/fireStations/add` | `FireStationController@add()` | Create new fire station |
| GET | `/fireStations/{id}/edit` | `FireStationController@formModifyFireStation()` | Show edit form |
| PUT | `/fireStations/{id}/update` | `FireStationController@update()` | Update fire station |
| DELETE | `/fireStations/{id}/delete` | `FireStationController@delete()` | Delete fire station |
| DELETE | `/fireStations/clear` | `FireStationController@clear()` | Clear all fire stations |

## Usage Examples

### List All Fire Stations
```
GET http://localhost:8000/fireStations
```

### Add New Fire Station
```
POST http://localhost:8000/fireStations/add
Body: {
    "name": "Central Station",
    "address": "123 Main St",
    "city": "Montreal",
    "phone": "514-555-0000",
    "id_state": 1
}
```

### Update Fire Station
```
PUT http://localhost:8000/fireStations/1/update
```

### Delete Fire Station
```
DELETE http://localhost:8000/fireStations/1/delete
```

### Clear All Stations
```
DELETE http://localhost:8000/fireStations/clear
```

## Testing

### Manual Testing
1. Run migrations: `php artisan migrate`
2. Seed test data: `php artisan db:seed`
3. Visit `http://localhost:8000`
4. Test all CRUD operations

### Feature Tests
```bash
php artisan test
```

## Version History

### v1.0 - Initial Release (2026-05-15)
- ✓ List fire stations functionality
- ✓ Add fire station functionality
- ✓ Modify fire station functionality
- ✓ Delete fire station functionality
- ✓ Clear all fire stations functionality
- ✓ State management and relationships
- ✓ Input validation
- ✓ User-friendly interface with Blade templates
- ✓ Database migrations

## License
This project is developed for Quebec fire station management.

## Support
For issues or questions, please contact the development team.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
