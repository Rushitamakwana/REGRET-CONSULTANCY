<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Traits\Notifiable;
use App\Models\Career;
use App\Models\JobApplication;

use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class CareerController extends Controller
{
    use Notifiable;

    /**
     * Display all careers (list page) with search, sort, pagination.
     */
    public function index(Request $request): View
    {
        // Get search query
        $search = $request->get('search', '');
        
        // Get sort parameters
        $sortColumn = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');
        
        // Get pagination limit
        $perPage = $request->get('per_page', 10);
        
        // Validate per_page options
        $allowedPerPage = [5, 10, 25, 50];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        // Allowed sort columns
        $allowedSortColumns = ['id', 'title', 'status', 'type', 'location', 'created_at'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        
        // Build query
        $query = Career::query();
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('details', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        
        // Apply sorting
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        
        // Get paginated results
        $careers = $query->paginate($perPage)->appends($request->query());
        
        return view('admin.careers.index', compact('careers', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    /**
     * Show the form for creating a new career.
     */
    public function create(): View
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created career.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full_time,part_time,remote,hybrid,contract',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $career = new Career();
        $career->title = $request->title;
        $career->details = $request->details ?? '';
        $career->location = $request->location ?? '';
        $career->type = $request->type;
        $career->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/careers'), $imageName);
            $career->image = $imageName;
        }

        $career->save();

        $this->logNotification('Career created', 'New career "' . $request->title . '" created successfully', 'success');

        return redirect()->route('careers.index')->with('success', 'Career created successfully!');
    }

    /**
     * Show the form for editing the specified career.
     */
    public function edit(Career $career): View
    {
        return view('admin.careers.edit', compact('career'));
    }

    /**
     * Update the specified career.
     */
    public function update(Request $request, Career $career)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full_time,part_time,remote,hybrid,contract',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $career->title = $request->title;
        $career->details = $request->details ?? '';
        $career->location = $request->location ?? '';
        $career->type = $request->type;
        $career->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($career->image && File::exists(public_path('uploads/careers/' . $career->image))) {
                File::delete(public_path('uploads/careers/' . $career->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/careers'), $imageName);
            $career->image = $imageName;
        }

        $career->save();

        $this->logNotification('Career updated', 'Career "' . $career->title . '" updated successfully', 'success');

        return redirect()->route('careers.index')->with('success', 'Career updated successfully!');
    }

    /**
     * Remove the specified career.
     */
    public function destroy(Request $request, Career $career)
    {
        // Check if AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            // Delete image if exists
            if ($career->image && File::exists(public_path('uploads/careers/' . $career->image))) {
                File::delete(public_path('uploads/careers/' . $career->image));
            }
            
            $career->delete();

            $this->logNotification('Career deleted', 'Career "' . $career->title . '" deleted', 'warning');

            return response()->json(['message' => 'Career deleted successfully!', 'success' => true]);
        }
        
        // Regular form submission (fallback)
        if ($career->image && File::exists(public_path('uploads/careers/' . $career->image))) {
            File::delete(public_path('uploads/careers/' . $career->image));
        }
        
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Career deleted successfully!');
    }

    /**
     * Display public career page with active positions.
     */
    public function publicIndex(): View
    {
        $careers = Career::where('status', 'active')->get();
        return view('Career', compact('careers'));
    }

    /**
     * Handle job application submission.
     */
    public function apply(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumeName = time() . '_' . $request->file('resume')->getClientOriginalName();
        $request->file('resume')->move(public_path('uploads/applications'), $resumeName);

        $application = JobApplication::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'resume' => $resumeName,
            'ip_address' => $request->ip(),
            'status' => 'pending',
        ]);

//       Mail::raw('New Application: ' . $request->name . ' - ' . $request->email . ' - ' . $request->position, function ($message) {
//     $message->to('rushitamakwana2601@gmail.com')->subject('New Job Application');
// });
        return redirect()->back()->with('success', 'Application submitted successfully! We will contact you soon.');
    }
}


