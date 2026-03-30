# Step-by-Step: Free Domain पर Laravel Project Live (Same Design + Database)

**Platform:** Railway.app (Free, Laravel Ready, Auto HTTPS)

## 1. Sign Up (1 min)
```
https://railway.app → Continue with GitHub (Rushitamakwana)
```

## 2. Deploy (2 min)
```
Dashboard → New Project → Deploy from GitHub repo
→ Rushitamakwana/REGRET-CONSULTANCY → Deploy
```
**Auto Domain:** `https://regret-consultancy.railway.app`

## 3. Add Database (Free MySQL)
```
Project → New → Database → MySQL → Add
```

## 4. Environment Variables (.env setup)
Variables tab → Add:
```
APP_NAME="Regret Consultancy"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://regret-consultancy.railway.app

DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=(from Railway MySQL vars)
DB_SSLMODE=require

CACHE_DRIVER=redis
SESSION_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=log
```

**Get DB Password:** MySQL service → Variables → Copy `MYSQL_PASSWORD`

## 5. Run Migrations & Seeders (Railway Shell)
```
Railway Shell (CLI icon) → Run:
php artisan migrate --force
php artisan db:seed --class=SuperAdminSeeder
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
exit
```

## 6. Live! Test
```
✅ Home page: https://regret-consultancy.railway.app
✅ Admin login: /login (email/password from seeder)
✅ Contact/Portfolio forms working
✅ Design 100% same
```

**Free Limits:** 512MB RAM, 1GB DB, unlimited traffic.

**Done!** Full Laravel app live with database, admin panel, forms - no issues.

**Alternative:** Render.com (similar steps).

