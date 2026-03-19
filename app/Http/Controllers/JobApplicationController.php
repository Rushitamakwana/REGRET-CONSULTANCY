<?php

namespace App\Http\Controllers;

use App\Traits\Notifiable;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class JobApplicationController extends Controller
{
    use Notifiable;

    /**
     * Display job applications list with search, sort, pagination.
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
        
        $allowedSortColumns = ['id', 'name', 'email', 'status', 'created_at'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        
        $query = JobApplication::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }
        
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        $applications = $query->paginate($perPage)->appends($request->query());
        
        return view('admin.applications.index', compact('applications', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    /**
     * Show specific application details.
     */
    public function show(JobApplication $application): View
    {
        return view('admin.applications.show', compact('application'));
    }


    /**
     * Mark application as read.
     */
    public function markAsRead(Request $request, JobApplication $application)
    {
        $application->update(['status' => 'read']);
        $this->logNotification('Application read', 'Job application from ' . $application->name . ' marked as read', 'info');
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Successfully marked as read!'
            ]);
        }
        
        return redirect()->back()->with('success', 'Successfully marked as read!');
    }


    /**
     * Delete application.
     */
    public function destroy(Request $request, JobApplication $application)
    {
        if ($request->ajax() || $request->wantsJson()) {
            if ($application->resume && File::exists(public_path('uploads/applications/' . $application->resume))) {
                File::delete(public_path('uploads/applications/' . $application->resume));
            }
            
            $application->delete();
            
            $this->logNotification('Application deleted', 'Job application from ' . $application->name . ' deleted', 'warning');
            
            return response()->json(['message' => 'Application deleted!', 'success' => true]);
        }
        
        return redirect()->route('applications.index')->with('success', 'Application deleted!');
    }
}

