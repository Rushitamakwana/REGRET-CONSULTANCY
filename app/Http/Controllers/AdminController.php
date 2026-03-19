<?php

namespace App\Http\Controllers;

use App\Traits\Notifiable;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with users list.
     */
    public function dashboard(Request $request): View
    {
        $search = $request->get('search', '');
        $sortColumn = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');
        $perPage = $request->get('per_page', 10);
        
        $allowedPerPage = [5, 10, 25, 50];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $query = User::query();
        
        $currentUserId = auth()->id();
        $query->where('id', '!=', $currentUserId);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $hasStatusColumn = \Schema::hasColumn('users', 'status');
        $allowedSortColumns = $hasStatusColumn ? ['id', 'email', 'name', 'status', 'created_at'] : ['id', 'email', 'name', 'created_at'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        
        if ($sortColumn === 'status' && !$hasStatusColumn) {
            $sortColumn = 'id';
        }
        
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        
        // Don't sort by status if column doesn't exist
        if ($sortColumn === 'status' && !$hasStatusColumn) {
            $sortColumn = 'id';
        }
        
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        
        // Get paginated results
        $users = $query->paginate($perPage)->appends($request->query());
        
// Stats
$totalServices = \App\Models\Service::count();
$totalPortfolios = \App\Models\Portfolio::count();
$totalContacts = \App\Models\Contact::count();
$totalJobs = \App\Models\JobApplication::count();
$activeServices = \App\Models\Service::where('status', 'active')->count();
$inactiveServices = \App\Models\Service::where('status', 'inactive')->count();
$recentServices = \App\Models\Service::latest()->limit(5)->get();
$recentContacts = \App\Models\Contact::latest()->limit(5)->get();
$recentApplications = \App\Models\JobApplication::latest()->limit(5)->get();
        
        // Get current user role
        $currentUserRole = auth()->user()->role ?? 'admin';
        
        return view('admin.dashboard', compact(
            'totalServices', 'totalPortfolios', 'totalContacts', 'totalJobs',
            'activeServices', 'inactiveServices', 'recentServices', 'recentContacts', 'recentApplications',
            'currentUserRole'
        ));
    }

    /**
     * Update user status.
     */
    public function updateStatus(Request $request, User $user)
    {
        // Check if status column exists
        if (!\Schema::hasColumn('users', 'status')) {
            return redirect()->back()->with('error', 'Status column does not exist. Please run migrations.');
        }

        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $user->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleStatus(User $user)
    {
        // Check if status column exists
        if (!\Schema::hasColumn('users', 'status')) {
            if (request()->ajax()) {
                return response()->json(['message' => 'Status column does not exist. Please run migrations.'], 422);
            }
            return redirect()->back()->with('error', 'Status column does not exist. Please run migrations.');
        }

        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);
        
        $this->logNotification('User status updated', "User {$user->name} status changed to {$newStatus}", 'success', ['user_id' => $user->id]);

        if (request()->ajax()) {
            return response()->json([
                'message' => 'User status updated successfully.',
                'status' => $newStatus
            ]);
        }

        return redirect()->back()->with('success', 'User status toggled successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        $this->logNotification('User deleted', "User {$user->name} was deleted", 'warning', ['user_id' => $user->id]);
        
        if (request()->ajax()) {
            return response()->json(['message' => 'User deleted successfully.']);
        }
        
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    /**
     * Get dashboard stats as JSON for AJAX updates.
     */
    public function getStats()
    {
        return response()->json([
            'totalServices' => \App\Models\Service::count(),
            'activeServices' => \App\Models\Service::where('status', 'active')->count(),
            'inactiveServices' => \App\Models\Service::where('status', 'inactive')->count(),
        ]);
    }

    /**
     * Show admin profile edit form
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update admin profile
     */

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateData = [
            'name' => $request->firstname . ' ' . trim($request->lastname ?? ''),
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar && File::exists(public_path('uploads/avatars/' . $user->avatar))) {
                File::delete(public_path('uploads/avatars/' . $user->avatar));
            }
            
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/avatars'), $filename);
            $updateData['avatar'] = $filename;
        }

        $user->update($updateData);
        
        $this->logNotification('Profile updated', 'Admin profile updated successfully', 'success');

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }


    /**
     * Show $portfolio form
     */
    public function changePassword()
    {
        return view('admin.change-password');
    }

    /**
     * Update password (separate from profile)
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard')->with('success', 'Password changed successfully!');
    }
}

