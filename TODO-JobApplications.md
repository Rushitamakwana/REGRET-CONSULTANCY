# Job Application System - TODO

**Status: Not Started**

## Steps:
1. [ ] Migration: create_job_applications_table
2. [ ] Model: app/Models/JobApplication.php
3. [ ] Controller: app/Http/Controllers/JobApplicationController.php (admin CRUD like careers)
4. [ ] Routes: POST careers/apply, admin/applications CRUD
5. [ ] Views: admin/applications/index.blade.php, show.blade.php (copy careers/contacts)
6. [ ] Update CareerController.php: apply() method
7. [ ] Update Career.blade.php: form action/route, position dropdown from $careers
8. [ ] php artisan migrate
9. [ ] Test form → admin table

**Fields:** name, email, phone, position, resume (file), status, ip

Resume: uploads/applications/

**Design:** Same as careers/services admin (search, sort, pagination, delete AJAX)
