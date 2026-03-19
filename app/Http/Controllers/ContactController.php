<?php

namespace App\Http\Controllers;

use App\Traits\Notifiable;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    use Notifiable;

    /**
     * Display all contacts/inquiries (list page) with search, sort, pagination.
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
        $allowedSortColumns = ['id', 'name', 'email', 'status', 'created_at'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'id';
        }
        
        // Build query
        $query = Contact::query();
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Apply sorting
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        
        // Get paginated results
        $contacts = $query->paginate($perPage)->appends($request->query());
        
        return view('admin.contacts.index', compact('contacts', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    /**
     * Mark contact as read.
     */
    public function markAsRead(Request $request, Contact $contact)
    {
        $contact->status = 'read';
        $contact->save();

        $this->logNotification('Contact marked as read', 'Contact from ' . $contact->name . ' marked as read', 'info');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Contact marked as read', 'success' => true]);
        }

        return redirect()->route('contacts.index')->with('success', 'Contact marked as read!');
    }

    /**
     * Remove the specified contact.
     */
    public function destroy(Request $request, Contact $contact)
    {
        // Check if AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            $contact->delete();

            $this->logNotification('Contact deleted', 'Contact from "' . $contact->name . '" deleted', 'warning');
            return response()->json(['message' => 'Contact deleted successfully!', 'success' => true]);
        }
        
        // Regular form submission (fallback)
        $contact->delete();

        $this->logNotification('Contact deleted', 'Contact from "' . $contact->name . '" deleted', 'warning');
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }

    /**
     * Store a new contact inquiry from frontend form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'unread',
        ]);

        $this->logNotification('New contact inquiry', 'New inquiry from ' . $request->name, 'info');

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}


