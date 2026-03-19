<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Career - Regret Consultancy</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
:root{
--primary:#0257b3;
--primary-hover:#0d9488;
--secondary:#0f172a;
}

body{background-color:#f1f5f9;}

.sidebar{background-color:var(--secondary);}
.topbar{background-color:var(--secondary);}

.btn-primary{
background-color:var(--primary);
color:white;
}

.btn-primary:hover{
background-color:var(--primary-hover);
}
</style>

</head>

<body class="font-sans">

@include('layouts.sidebar')
@include('layouts.topbar')

<!-- MAIN -->
<main class="pt-16 p-4 md:p-6 md:ml-64">

<div class="max-w-3xl mx-auto">

<div class="card rounded-xl shadow-sm border border-slate-200 overflow-hidden">

<!-- HEADER -->
<div class="p-4 md:p-6 border-b border-slate-200">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

<div>
<h3 class="text-lg md:text-xl font-bold text-[#1e293b]">Edit Career</h3>
<p class="text-sm text-slate-500 mt-1">Update career opportunity</p>
</div>

<a href="{{ route('careers.index') }}"
class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 inline-flex items-center gap-2 w-full sm:w-auto justify-center">

<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
viewBox="0 0 24 24" stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

</svg>

Back

</a>

</div>

</div>

<!-- FORM -->
<form method="POST"
action="{{ route('careers.update', $career->id) }}"
enctype="multipart/form-data"
class="p-4 md:p-6">

@csrf
@method('PUT')

<!-- TITLE -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Title <span class="text-red-500">*</span>
</label>

<input type="text"
name="title"
id="title"
value="{{ old('title', $career->title) }}"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('title') border-red-500 @enderror"
placeholder="Enter career title">

@error('title')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>


<!-- DETAILS -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Details
</label>

<textarea name="details"
rows="4"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('details') border-red-500 @enderror"
placeholder="Enter career details">{{ old('details', $career->details) }}</textarea>

@error('details')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>


<!-- LOCATION -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Location
</label>

<input type="text"
name="location"
value="{{ old('location', $career->location) }}"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] @error('location') border-red-500 @enderror"
placeholder="Enter location">

@error('location')
<p class="mt-1 text-sm text-red-500">{{ $message }}</p>
@enderror

</div>


<!-- TYPE -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Type <span class="text-red-500">*</span>
</label>

<select name="type"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]">

<option value="" disabled>Select type</option>

<option value="full_time"
{{ old('type',$career->type)=='full_time'?'selected':'' }}>
Full Time
</option>

<option value="part_time"
{{ old('type',$career->type)=='part_time'?'selected':'' }}>
Part Time
</option>

<option value="remote"
{{ old('type',$career->type)=='remote'?'selected':'' }}>
Remote
</option>

<option value="hybrid"
{{ old('type',$career->type)=='hybrid'?'selected':'' }}>
Hybrid
</option>

<option value="contract"
{{ old('type',$career->type)=='contract'?'selected':'' }}>
Contract
</option>

</select>

</div>


<!-- IMAGE -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Image
</label>

@if($career->image)

<div class="mb-3">
<img src="{{ asset('uploads/careers/'.$career->image) }}"
class="w-28 h-28 md:w-32 md:h-32 object-cover rounded-lg">
<p class="mt-1 text-xs text-slate-500">Current image</p>
</div>

@endif

<input type="file"
name="image"
accept="image/*"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]">

<p class="mt-1 text-xs text-slate-500">
Allowed: jpeg, png, jpg, gif, svg. Max 2MB.
</p>

</div>


<!-- STATUS -->
<div class="mb-6">

<label class="block text-sm font-medium text-slate-700 mb-2">
Status
</label>

<select name="status"
class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3]">

<option value="active"
{{ old('status',$career->status)=='active'?'selected':'' }}>
Active
</option>

<option value="inactive"
{{ old('status',$career->status)=='inactive'?'selected':'' }}>
Inactive
</option>

</select>

</div>


<!-- BUTTON -->
<div class="flex flex-col sm:flex-row justify-start gap-3">



<button type="submit"
class="btn-primary px-6 py-2 rounded-lg w-full sm:w-auto">
Update Career
</button>
<a href="{{ route('careers.index') }}"
class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 w-full sm:w-auto text-center">
Cancel
</a>
</div>

</form>

</div>
</div>

</main>

</body>
</html>