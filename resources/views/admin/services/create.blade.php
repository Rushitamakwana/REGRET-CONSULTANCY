<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Service - Regret Consultancy</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
:root {
--primary: #0257b3;
--primary-hover: #0d9488;
--secondary: #0f172a;
}

body { background-color: #f1f5f9; }

.sidebar { background-color: var(--secondary); }

.topbar { background-color: var(--secondary); }

</style>
</head>

<body class="font-sans">

@include('layouts.sidebar')
@include('layouts.topbar')

<!-- Main Content -->

<main class="pt-16 p-4 md:p-6 md:ml-64 mt-10">

<div class="card rounded-xl shadow-sm border border-slate-200 overflow-hidden">

<div class="p-4 md:p-6 border-b border-slate-200">

<h3 class="text-xl font-bold text-[#1e293b]">Add New Service</h3>

<p class="text-sm text-slate-500 mt-1">Create a new service</p>

</div>

<div class="p-4 md:p-6">

<form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<!-- Title -->

<div class="mb-4">

<label class="block text-sm font-medium text-slate-700 mb-2">
Title <span class="text-red-500">*</span>
</label>

<input type="text"
name="title"
value="{{ old('title') }}"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]"
required>

@error('title')

<p class="text-red-500 text-sm mt-1">{{ $message }}</p>

@enderror

</div>

<!-- Description -->

<div class="mb-4">

<label class="block text-sm font-medium text-slate-700 mb-2">
Description
</label>

<textarea
name="description"
rows="4"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]"
>{{ old('description') }}</textarea>

</div>

<!-- Image -->

<div class="mb-4">

<label class="block text-sm font-medium text-slate-700 mb-2">
Image
</label>

<input
type="file"
name="image"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]"
accept="image/*">

@error('image')

<p class="text-red-500 text-sm mt-1">{{ $message }}</p>

@enderror

</div>

<!-- Deliverables -->

<div class="mb-4">

<label class="block text-sm font-medium text-slate-700 mb-2">
Deliverables
</label>

<textarea
name="deliverables"
rows="3"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]"
>{{ old('deliverables') }}</textarea>

@error('deliverables')
<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror

</div>

<!-- Status -->

<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Status <span class="text-red-500">*</span>
</label>

<select
name="status"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]"
required>

<option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
Active
</option>

<option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

<!-- Buttons -->

<div class="flex flex-col sm:flex-row gap-3">

<button
type="submit"
class="bg-[#0257b3] hover:bg-[#0d9488] text-white px-6 py-2 rounded-lg transition-colors w-full sm:w-auto">

Create Service

</button>

<a
href="{{ route('services.index') }}"
class="px-6 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 text-center w-full sm:w-auto">

Cancel

</a>

</div>

</form>

</div>

</div>

</main>

</body>
</html>