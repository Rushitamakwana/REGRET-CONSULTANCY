<?php

namespace App\Http\Controllers;

use App\Traits\Notifiable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    use Notifiable;

    /**
     * Display all services (list page) with search, sort, pagination.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search', '');
        $sortColumn = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [5, 10, 25, 50];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        $allowedSortColumns = ['id', 'title', 'status', 'created_at'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        $query = Service::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        $services = $query->paginate($perPage)->appends($request->query());
        return view('admin.services.index', compact('services', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deliverables' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description ?? '';
        $service->deliverables = $request->deliverables ?? '';
        $service->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }

        $service->save();

        $this->logNotification('Service created', 'New service "' . $request->title . '" created successfully', 'success');

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deliverables' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $service->title = $request->title;
        $service->description = $request->description ?? '';
        $service->deliverables = $request->deliverables ?? '';
        $service->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image && File::exists(public_path('uploads/services/' . $service->image))) {
                File::delete(public_path('uploads/services/' . $service->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }

        $service->save();

        $this->logNotification('Service updated', 'Service "' . $service->title . '" updated successfully', 'success');

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Request $request, Service $service)
    {
        // Check if AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            // Delete image if exists
            if ($service->image && File::exists(public_path('uploads/services/' . $service->image))) {
                File::delete(public_path('uploads/services/' . $service->image));
            }
            
            $service->delete();

            $this->logNotification('Service deleted', 'Service "' . $service->title . '" deleted', 'warning');

            return response()->json(['message' => 'Service deleted successfully!', 'success' => true]);
        }
        
        // Regular form submission (fallback)
        if ($service->image && File::exists(public_path('uploads/services/' . $service->image))) {
            File::delete(public_path('uploads/services/' . $service->image));
        }
        
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }

    /**
     * Display public services listing (frontend).
     */
    public function publicIndex(Request $request)
    {
        $services = Service::where('status', 'active')->get();
        return view('Services', compact('services'));
    }

    /**
     * Display specific service details (frontend).
     */
    public function show(Service $service)
    {
        if ($service->status !== 'active') {
            abort(404, 'Service not found');
        }
        return view('ServiceDetails', compact('service'));
    }
}
