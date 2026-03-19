# Career Page Dynamic Openings - Implementation Steps

**Status: In Progress**

## Plan Details:
- **Information Gathered**: Career.blade.php has hardcoded "Current Openings" accordions. CareerController has admin CRUD only. No public route/controller method. Model has title, details, location, type, image, status. Admin routes exist.
- **Current Route**: Route::get('/Career', function () { return view('Career'); });
- **Goal**: Only "Current Openings" section dynamic via @forelse($careers), keep rest static.

## Steps:
1. [✅] Create TODO-Career.md
2. [✅] Add public route in routes/web.php: GET /Career → CareerController@publicIndex ('careers.public')
3. [✅] Add publicIndex() in app/Http/Controllers/CareerController.php: Load active careers → view('Career', compact('careers'))
4. [✅] Update resources/views/Career.blade.php: Replace hardcoded accordions with @forelse($careers) loop using $career->title, $career->details, $career->type, $career->location
5. [✅] Fixed: Route /Career (capital C) → dynamic list from admin
6. [✅] Complete

**Notes:**
- Keep accordion JS, styling, other sections unchanged.
- Use $career->type for badges (full_time → "Full-time"), $career->location.
- Image: $career->image ? asset('uploads/careers/'.$career->image) 

Confirm plan before edits?

