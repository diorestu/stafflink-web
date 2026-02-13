# StaffLink Web (Private)

Internal company website and CMS built with Laravel.

## Main Features
- Public company profile pages
- Jobs and career listing
- Appointment booking
- Admin CMS for content management
- Custom Pages module with GrapesJS WYSIWYG builder

## Tech Stack
- Laravel (PHP)
- MySQL
- Blade + Vite + Tailwind

## Quick Start
1. Install dependencies
   - `composer install`
   - `npm install`
2. Configure environment
   - `cp .env.example .env`
   - set DB credentials in `.env`
   - optional: set `OPENAI_API_KEY` for AI field completion on pages
3. App setup
   - `php artisan key:generate`
   - `php artisan migrate`
4. Run app
   - `php artisan serve`
   - `npm run dev`

## Useful Commands
- `php artisan migrate`
- `php artisan route:list`
- `php artisan pages:sync-routes` (create/update draft pages from public routes, excluding admin)

## Notes
- Admin area: `/admin`
- Generated/public custom pages are served at `/p/{slug}`
- This repository is private and intended for internal use only.
