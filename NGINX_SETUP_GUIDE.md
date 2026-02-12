# Nginx Configuration Guide for StaffLink

## Problem
Only the home page (`/`) works, all other routes like `/appointment`, `/contact`, etc. return 404 errors.

## Root Cause
Nginx is not configured to route requests through Laravel's `index.php` front controller.

## Solution Steps

### 1. Backup Your Current Configuration
```bash
sudo cp /etc/nginx/sites-available/stafflink_web /etc/nginx/sites-available/stafflink_web.backup
```

### 2. Update Your Nginx Configuration

**Option A: Edit existing file**
```bash
sudo nano /etc/nginx/sites-available/stafflink_web
```

**Option B: Create new file**
```bash
sudo nano /etc/nginx/sites-available/stafflink_web
```

Then copy the contents from `nginx-config.conf` in this directory.

### 3. Important Configuration Points to Verify

#### ✅ Document Root (CRITICAL)
```nginx
root /var/www/stafflink_web/public;  # Must point to 'public' directory
```

**NOT:**
```nginx
root /var/www/stafflink_web;  # ❌ Wrong - missing /public
```

#### ✅ Try Files Directive (CRITICAL)
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

This line is what makes Laravel routing work!

#### ✅ PHP-FPM Socket Path
Find your PHP version and socket:
```bash
php -v
ls -la /var/run/php/
```

Common paths:
- PHP 8.2: `unix:/var/run/php/php8.2-fpm.sock`
- PHP 8.1: `unix:/var/run/php/php8.1-fpm.sock`
- PHP 8.0: `unix:/var/run/php/php8.0-fpm.sock`

Update this line in your config:
```nginx
fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;  # Adjust version
```

#### ✅ Server Name
Replace with your actual domain:
```nginx
server_name your-domain.com www.your-domain.com;
```

Or use your server IP:
```nginx
server_name 123.456.789.012;
```

### 4. Enable the Site (if not already enabled)
```bash
sudo ln -s /etc/nginx/sites-available/stafflink_web /etc/nginx/sites-enabled/
```

### 5. Test Nginx Configuration
```bash
sudo nginx -t
```

You should see:
```
nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
```

### 6. Reload Nginx
```bash
sudo systemctl reload nginx
```

Or restart if reload doesn't work:
```bash
sudo systemctl restart nginx
```

### 7. Verify PHP-FPM is Running
```bash
sudo systemctl status php8.2-fpm  # Adjust version
```

If not running:
```bash
sudo systemctl start php8.2-fpm
sudo systemctl enable php8.2-fpm
```

### 8. Check Permissions
```bash
# Ensure nginx can read your files
sudo chown -R www-data:www-data /var/www/stafflink_web
sudo chmod -R 755 /var/www/stafflink_web

# Storage and cache must be writable
sudo chmod -R 775 /var/www/stafflink_web/storage
sudo chmod -R 775 /var/www/stafflink_web/bootstrap/cache
```

### 9. Test Your Routes

Visit these URLs in your browser:
- ✅ `http://your-domain.com/` (home page)
- ✅ `http://your-domain.com/appointment` (should work now!)
- ✅ `http://your-domain.com/contact`
- ✅ `http://your-domain.com/jobs`

## Troubleshooting

### Still Getting 404?

**Check nginx error logs:**
```bash
sudo tail -f /var/log/nginx/error.log
```

**Check Laravel logs:**
```bash
tail -f /var/www/stafflink_web/storage/logs/laravel.log
```

### Check if nginx is using the right config:
```bash
sudo nginx -T | grep "root"
```

Should show: `root /var/www/stafflink_web/public;`

### Verify PHP-FPM socket exists:
```bash
ls -la /var/run/php/
```

### Test PHP processing:
Create a test file:
```bash
echo "<?php phpinfo();" | sudo tee /var/www/stafflink_web/public/info.php
```

Visit: `http://your-domain.com/info.php`

If you see PHP info, PHP is working. Delete the file after:
```bash
sudo rm /var/www/stafflink_web/public/info.php
```

## Common Mistakes to Avoid

1. ❌ **Document root not pointing to `/public`**
2. ❌ **Missing `try_files` directive**
3. ❌ **Wrong PHP-FPM socket path**
4. ❌ **Wrong file permissions**
5. ❌ **Not reloading nginx after changes**
6. ❌ **PHP-FPM not running**

## Quick Diagnostic Commands

```bash
# Check nginx status
sudo systemctl status nginx

# Check PHP-FPM status
sudo systemctl status php8.2-fpm

# Check which config nginx is using
sudo nginx -T | grep -A 20 "server_name"

# Check document root
sudo nginx -T | grep "root"

# View recent nginx errors
sudo tail -20 /var/log/nginx/error.log

# Check file permissions
ls -la /var/www/stafflink_web/public/
```

## Need More Help?

If you're still having issues, run these diagnostic commands and share the output:

```bash
# 1. Nginx configuration test
sudo nginx -t

# 2. Check document root
sudo nginx -T | grep "root"

# 3. Check try_files
sudo nginx -T | grep "try_files"

# 4. PHP version and socket
php -v
ls -la /var/run/php/

# 5. Recent errors
sudo tail -20 /var/log/nginx/error.log
```
