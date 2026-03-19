# Contact Form Integration - Steps

**Status: Not Started**

## Plan:
1. [✅] Add POST /contact route → ContactController@store
2. [✅] Create ContactController@store - validate/save Contact model  
3. [✅] Update Conatct.blande.php form → method="POST" action="{{ route('contact.store') }}"
4. [ ] Fix admin.contacts.index view if missing
5. [ ] Test form submit → admin table
6. [ ] [attempt_completion]

**Status: Contact form now submits to database!**

**Dependent files:**
- routes/web.php
- app/Http/Controllers/ContactController.php  
- resources/views/Conatct.blande.php
- Model Contact.php (exists)

