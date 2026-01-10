# GitHub Copilot Instructions

## Project Overview

This is a **Laravel 12 + Blade starter kit** that provides authentication, profile management, and LetsPeppol API integration. It's designed as a simple, Blade-only starter kit with a CoreUI/AdminLTE-inspired design layout.

### Technology Stack

- **Backend**: Laravel 12 (PHP 8.4+)
- **Frontend**: Blade templates + AlpineJS
- **Styling**: TailwindCSS v4
- **Build Tool**: Vite
- **Package Manager**: Composer (PHP), npm/yarn (JavaScript)
- **Architecture**: Modular Laravel (using internachi/modular)

### Key Features

- Authentication system (login, registration, password reset, email confirmation)
- Dashboard and profile management
- LetsPeppol API integration for e-invoicing (KYC, Proxy, and App APIs)
- OpenAPI 3.0 specifications for API documentation

## Code Style & Formatting

### PHP Code Style

- **Standard**: PSR-12 with PER preset (Laravel Pint configuration)
- **Formatter**: Laravel Pint (see `pint.json`)
- **Static Analysis**: PHPStan level 5 (see `phpstan.neon`)
- **Refactoring**: Rector configured (see `rector.php`)

#### Key PHP Conventions

- Use **short array syntax**: `[]` instead of `array()`
- Use **single quotes** for strings unless interpolation is needed
- **Align assignment operators** (`=` and `=>`) for readability
- **No strict types declaration** by default (see `pint.json`)
- **Use arrow functions sparingly** (traditional closures preferred)
- Import classes, constants, and functions with `use` statements
- Use `not` operator with space: `! $condition`
- Prefer `echo` over `print`
- Use null coalescing assignment: `$var ??= value`
- **Order class elements**: traits, constants, properties, constructor, magic methods, public methods, protected methods, private methods

### Blade Templates

- **Formatter**: Prettier with `@shufo/prettier-plugin-blade`
- **Tab width**: 4 spaces for Blade files
- **Single quotes** preferred
- TailwindCSS classes auto-sorted

### JavaScript/AlpineJS

- **Single quotes** for strings
- Follow standard Prettier formatting
- Use AlpineJS for interactive components

### General Editor Config

- **Charset**: UTF-8
- **Line endings**: LF
- **Indent**: 4 spaces (2 for YAML files)
- **Trim trailing whitespace**: Yes
- **Final newline**: Yes

## Project Structure

```
├── app/                          # Laravel application code
│   └── Services/LetsPeppol/      # LetsPeppol API client
├── app-modules/                  # Modular architecture (tests included)
├── docs/api/                     # API documentation
├── specs/                        # OpenAPI specifications (YAML)
├── resources/                    # Views, CSS, JS
├── routes/                       # Laravel routes
├── tests/                        # PHPUnit tests (Unit & Feature)
├── composer.json                 # PHP dependencies
├── package.json                  # JavaScript dependencies
└── pint.json                     # PHP code style rules
```

## Development Workflow

### Setup Commands

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install  # or yarn

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate
```

### Development Server

```bash
# Run all services concurrently (server, queue, logs, vite)
composer dev

# Or individually:
php artisan serve
npm run dev
```

### Code Quality

```bash
# Format PHP code
./vendor/bin/pint

# Run static analysis
./vendor/bin/phpstan analyse

# Run Rector (refactoring)
./vendor/bin/rector process

# Format Blade templates
npm run format  # (if configured)
```

### Testing

```bash
# Run all tests
composer test
# or
php artisan test

# Run specific test suite
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run tests for modules
php artisan test --testsuite=Modules
```

### Cache Management

```bash
# Clear all caches (view, config, cache, route)
composer aargh
```

## Architecture Guidelines

### Modular Structure

- Use Laravel modules (internachi/modular) for feature organization
- Place module tests in `app-modules/*/tests`
- Each module should be self-contained with its own controllers, models, views

### Service Layer

- Complex business logic should be in service classes (e.g., `App\Services\LetsPeppol\`)
- Services should be type-hinted and injected via constructor

### Blade Components

- Use Blade components for reusable UI elements
- Utilize AlpineJS for interactive behavior
- Keep JavaScript minimal and in-line with Blade where appropriate

### API Integration

- All LetsPeppol API clients are in `App\Services\LetsPeppol\`
- Use the unified `LetsPeppolClient` for authentication and accessing sub-clients
- OpenAPI specs in `specs/` directory for reference

## Testing Practices

### Test Structure

- **Unit tests**: `tests/Unit/` - Test individual classes/methods
- **Feature tests**: `tests/Feature/` - Test HTTP endpoints and user flows
- **Module tests**: `app-modules/*/tests` - Test module-specific functionality

### Test Database

- Uses SQLite in-memory database (`:memory:`)
- Configured in `phpunit.xml`

### Writing Tests

- Use Laravel's testing helpers and assertions
- Mock external API calls (LetsPeppol APIs)
- Follow existing test patterns in the codebase

## LetsPeppol API Integration

### Overview

Three API modules:
1. **KYC API** - Authentication and registration
2. **Proxy API** - Document transmission
3. **App API** - Document management

### Environment Variables

```env
LETSPEPPOL_KYC_URL=https://kyc.letspeppol.org
LETSPEPPOL_PROXY_URL=https://proxy.letspeppol.org
LETSPEPPOL_APP_URL=https://app.letspeppol.org
```

### Usage Pattern

```php
use App\Services\LetsPeppol\LetsPeppolClient;

// Authenticate and get client
$client = new LetsPeppolClient();
$token = $client->authenticate($email, $password);

// Access sub-clients
$client->kyc()->getCompany($peppolId);
$client->proxy()->getAllNewDocuments();
$client->app()->listDocuments($filters);
```

### Documentation

- Quick start: `docs/api/LETSPEPPOL-QUICKSTART.md`
- Full docs: `docs/api/LETSPEPPOL.md`
- OpenAPI specs: `specs/letspeppol-*.yaml`

## Best Practices

### Code Organization

- Keep controllers thin, move logic to services or actions
- Use form requests for validation
- Use policies for authorization
- Type-hint parameters and return types where beneficial

### Security

- Always validate and sanitize user input
- Use Laravel's CSRF protection
- Use prepared statements (Eloquent does this by default)
- Never commit secrets or API keys

### Performance

- Use eager loading to avoid N+1 queries
- Cache expensive operations
- Use queues for long-running tasks
- Optimize database queries

### Documentation

- Document complex business logic
- Add PHPDoc blocks for public methods
- Keep README and docs updated

## Common Commands Reference

| Task | Command |
|------|---------|
| Install dependencies | `composer install && npm install` |
| Start dev server | `composer dev` |
| Format code | `./vendor/bin/pint` |
| Run tests | `composer test` |
| Static analysis | `./vendor/bin/phpstan analyse` |
| Clear caches | `composer aargh` |
| Build assets | `npm run build` |
| Run migrations | `php artisan migrate` |

## Additional Notes

- This is a **work-in-progress** starter kit
- Focus on simplicity: Blade-only, no Vue/Livewire/React
- Designed for Laravel Daily demo applications
- MIT licensed
