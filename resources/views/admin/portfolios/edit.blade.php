<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Portfolio - Regret Consultancy</title>
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

.btn-primary { background-color: var(--primary); color: white; }

.btn-primary:hover { background-color: var(--primary-hover); }

</style>
</head>

<body class="font-sans">

@include('layouts.sidebar')
@include('layouts.topbar')

<main class="pt-16 p-4 md:p-6 md:ml-64 mt-10">

<div class="max-w-3xl mx-auto">

<div class="rounded-xl shadow-sm border border-slate-200 overflow-hidden">

<div class="p-4 md:p-6 border-b border-slate-200">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

<div>

<h3 class="text-xl font-bold text-[#1e293b]">Edit Portfolio</h3>

<p class="text-sm text-slate-500 mt-1">Update portfolio entry</p>

</div>

<a href="{{ route('portfolios.index') }}"
class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 inline-flex items-center gap-2 justify-center">

<svg xmlns="http://www.w3.org/2000/svg"
class="h-5 w-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

</svg>

Back

</a>

</div>

</div>

<form method="POST"
action="{{ route('portfolios.update', $portfolio) }}"
enctype="multipart/form-data"
class="p-4 md:p-6">

@csrf
@method('PUT')

<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Title <span class="text-red-500">*</span>
</label>

<input type="text"
name="title"
value="{{ old('title', $portfolio->title) }}"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('title') border-red-500 @enderror"
placeholder="Enter portfolio title">

@error('title')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>

<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Description
</label>

<textarea
name="description"
rows="4"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('description') border-red-500 @enderror"
placeholder="Enter portfolio description">{{ old('description', $portfolio->description) }}</textarea>

@error('description')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>

<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Image
</label>

@if($portfolio->image)

<div class="mb-3">

<img
src="{{ asset('uploads/portfolios/' . $portfolio->image) }}"
class="w-28 h-28 md:w-32 md:h-32 object-cover rounded-lg">

<p class="mt-1 text-xs text-slate-500">
Current image (new upload replaces it)
</p>

</div>

@endif

<input
type="file"
name="image"
accept="image/*"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('image') border-red-500 @enderror">

<p class="mt-1 text-xs text-slate-500">
jpeg, png, jpg, gif, svg. Max 2MB. Leave empty to keep current.
</p>

@error('image')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>

<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Status <span class="text-red-500">*</span>
</label>

<select
name="status"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('status') border-red-500 @enderror">

<option value="active" {{ old('status', $portfolio->status) == 'active' ? 'selected' : '' }}>
Active
</option>

<option value="inactive" {{ old('status', $portfolio->status) == 'inactive' ? 'selected' : '' }}>
Inactive
</option>

</select>

@error('status')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>

<div class="flex flex-col sm:flex-row justify-start gap-3">



<button type="submit"
class="btn-primary px-6 py-2 rounded-lg">

Update Portfolio

</button>
<a href="{{ route('portfolios.index') }}"
class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-center">

Cancel

</a>
</div>

</form>

</div>

</div>

</main>

</body>
</html>