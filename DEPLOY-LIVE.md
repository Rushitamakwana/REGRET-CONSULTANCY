# Free Domain Deployment Options (No Code Changes)

## Option 1: Render.com (Recommended Railway Alternative - Free PHP + Postgres)

**1. Sign Up:**
```
https://render.com → GitHub login (Rushitamakwana)
```

**2. Web Service:**
```
New → Web Service → REGRET-CONSULTANCY repo
→ Runtime: PHP 8.3 (select PHP, not Node)
→ Root Directory: ./
→ Build Command: `composer install --no-dev --optimize-autoloader && npm install && npm run build && php artisan config:cache && php artisan route:cache && php artisan view:cache`
→ Start Command: `vendor/bin/heroku-php-apache2 public/`
→ Instance Type: Free
```

**3. PostgreSQL (Free):**
```
New → PostgreSQL → Free
```

**4. Environment Variables:**
```
DATABASE_URL=postgres://username:password@host:port/db (copy from Postgres → Info)
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourapp.onrender.com
MAIL_MAILER=log
```

**5. Shell (after deploy):**
```
php artisan migrate --force
php artisan db:seed --class=SuperAdminSeeder
```

**Domain:** https://regretconsultancy-xyz.onrender.com ✅ LIVE!

## Option 2: Koyeb (Free Nano)
```
koyeb.com → GitHub repo → PHP → Auto detect → Deploy
Free MySQL add-on available
Domain: yourapp.koyeb.app
```

## Option 3: Fly.io (CLI Deploy)
```
npm i -g flyctl
fly launch --no-deploy
# Edit fly.toml: primary_region = "ord", swap php artisan serve with vendor/bin/heroku-php-apache2 public/
fly deploy
fly postgres create
```

**All options: Full project live (admin/database/forms) - NO code changes needed.**

**Repo ready:** https://github.com/Rushitamakwana/REGRET-CONSULTANCY

**Pick Render.com for easiest deploy!**

