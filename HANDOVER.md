# StaffLink Web Project Handover

## 1. Project Summary

StaffLink Web is the company website and internal CMS for StaffLink Solutions.

The system covers:
- Public marketing pages
- Service and staffing pages
- Blog content
- Job listings and applicant intake
- Appointment booking
- Contact inquiry intake
- Wedding nanny inquiry intake
- Admin CMS for content and operations

Primary admin entry point:
- `/admin`

## 2. Current Tech Stack

- PHP 8.2+
- Laravel 12
- Blade templates
- Tailwind CSS 4
- Vite 7
- MySQL
- Laravel queue/database-backed session/cache

Notable packages:
- `spatie/laravel-analytics`
- `me-shaon/laravel-request-analytics`

## 3. Main Functional Areas

### Public Website
- Home page and static marketing pages
- Service detail and sector pages
- Blog listing and article pages
- Global staffing landing pages by country
- Contact page
- Appointment booking page
- Job application form
- Wedding nanny inquiry form

### Admin CMS
- Dashboard
- Pages
- Careers / services
- Service categories
- Service areas
- Blog posts
- FAQs
- Applicants
- Leads
- Contact inquiries
- Nanny inquiries
- Appointments
- Analytics
- User management
- Header/footer settings
- Page wording / role page wording

## 4. Current Status

The project is operational as a Laravel web app with database-backed CMS features.

Working business flows currently present in the codebase:
- Appointment booking with admin management
- Job application submission with admin review
- Wedding nanny inquiry submission with admin listing/export
- Contact inquiry submission with admin listing

Recent update completed:
- The public Contact Us form is now connected to the database
- Incoming contact inquiries now appear in the admin panel

## 5. Contact Inquiry Flow

The contact form was previously only a static frontend form. It is now persisted.

Current behavior:
- Public page: `/contact`
- Submits to a Laravel POST route
- Saves data into `contact_inquiries`
- Displays success/validation feedback on the page
- Admin can review submissions in:
  - `/admin/contact-inquiries`

Stored contact fields:
- Name
- Email
- Phone
- Company name
- Company size
- Preferred call time
- Preferred call date
- Message
- Submitter IP / user agent

## 6. Important Paths

Key project files and directories:
- [README.md](/Users/user/Documents/PROJECTS/stafflink_web/README.md)
- [routes/web.php](/Users/user/Documents/PROJECTS/stafflink_web/routes/web.php)
- [app/Http/Controllers](/Users/user/Documents/PROJECTS/stafflink_web/app/Http/Controllers)
- [app/Models](/Users/user/Documents/PROJECTS/stafflink_web/app/Models)
- [resources/views](/Users/user/Documents/PROJECTS/stafflink_web/resources/views)
- [database/migrations](/Users/user/Documents/PROJECTS/stafflink_web/database/migrations)
- [config](/Users/user/Documents/PROJECTS/stafflink_web/config)

Files related to the new contact inquiry feature:
- [app/Http/Controllers/ContactInquiryController.php](/Users/user/Documents/PROJECTS/stafflink_web/app/Http/Controllers/ContactInquiryController.php)
- [app/Http/Controllers/AdminContactInquiryController.php](/Users/user/Documents/PROJECTS/stafflink_web/app/Http/Controllers/AdminContactInquiryController.php)
- [app/Models/ContactInquiry.php](/Users/user/Documents/PROJECTS/stafflink_web/app/Models/ContactInquiry.php)
- [resources/views/contact.blade.php](/Users/user/Documents/PROJECTS/stafflink_web/resources/views/contact.blade.php)
- [resources/views/admin/contact-inquiries/index.blade.php](/Users/user/Documents/PROJECTS/stafflink_web/resources/views/admin/contact-inquiries/index.blade.php)
- [database/migrations/2026_03_09_100000_create_contact_inquiries_table.php](/Users/user/Documents/PROJECTS/stafflink_web/database/migrations/2026_03_09_100000_create_contact_inquiries_table.php)

## 7. Environment and Services

Expected infrastructure/services:
- Web server / PHP runtime
- MySQL database
- Mail server for notifications
- Node.js for asset build

Environment configuration exists through `.env`.

Important configuration groups:
- App URL / environment
- Database connection
- Mail credentials
- Queue/session/cache drivers
- Analytics settings

## 8. Local Setup

Typical setup flow:

1. Install PHP dependencies
   - `composer install`
2. Install frontend dependencies
   - `npm install`
3. Configure environment
   - copy `.env.example` to `.env`
   - set database credentials
   - set mail credentials
4. Generate app key
   - `php artisan key:generate`
5. Run migrations
   - `php artisan migrate`
6. Start app
   - `php artisan serve`
   - `npm run dev`

Useful commands:
- `php artisan migrate`
- `php artisan route:list`
- `php artisan test`
- `npm run build`

## 9. Deployment / Handover Checklist

Before final transfer, confirm the following with the receiving owner:

- Production `.env` is available and stored securely
- Database backup exists
- Mailbox credentials are controlled by the company
- Admin user accounts are current
- Domain / hosting access is documented
- SSL / DNS ownership is known
- Scheduled jobs or queue workers, if used in production, are documented

## 10. Recommended Access Items to Transfer

- Git repository access
- Hosting/server access
- Database access
- Domain/DNS access
- Mail account ownership
- Analytics account access
- Admin CMS user account

## 11. Known Operational Notes

- The app relies on database-backed Laravel features, including sessions/cache/queue configuration in environment files.
- There are multiple admin modules already in place, so database migrations should always be run during deployment when code changes include schema updates.
- The codebase appears to be actively changing; there are local workspace changes outside this handover update. Those should be reviewed separately before packaging or deploying.

## 12. Risks / Follow-Up Items

- There is no detailed automated test coverage summary in the repository handover docs.
- Feature ownership and production deployment steps are not fully documented yet.
- Secret rotation should be part of the handover if credentials have been shared across team members.
- A short SOP for content editing, lead follow-up, and inquiry handling would improve business continuity.

## 13. Suggested Message to Accompany This Handover

You can send this project with a short note such as:

> Attached is the StaffLink Web project handover.  
> It includes the current website/CMS scope, setup requirements, key modules, and the latest status.  
> The Contact Us form is now connected to the database and submissions are visible in the admin panel under Contact Inquiries.

