<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    use \App\Traits\Notifiable;

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
        $query = Portfolio::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        $portfolios = $query->paginate($perPage)->appends($request->query());
        return view('admin.portfolios.index', compact('portfolios', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    public function create(): View
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $portfolio = new Portfolio();
        $portfolio->title = $request->title;
        $portfolio->description = $request->description ?? '';
        $portfolio->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/portfolios'), $imageName);
            $portfolio->image = $imageName;
        }

        $portfolio->save();

        $this->logNotification('Portfolio created', 'New portfolio "' . $request->title . '" created successfully', 'success');

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $portfolio->title = $request->title;
        $portfolio->description = $request->description ?? '';
        $portfolio->status = $request->status;

        if ($request->hasFile('image')) {
            if ($portfolio->image && File::exists(public_path('uploads/portfolios/' . $portfolio->image))) {
                File::delete(public_path('uploads/portfolios/' . $portfolio->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/portfolios'), $imageName);
            $portfolio->image = $imageName;
        }

        $portfolio->save();

        $this->logNotification('Portfolio updated', 'Portfolio "' . $portfolio->title . '" updated successfully', 'success');

        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Request $request, Portfolio $portfolio)
    {
        if ($request->ajax() || $request->wantsJson()) {
            if ($portfolio->image && File::exists(public_path('uploads/portfolios/' . $portfolio->image))) {
                File::delete(public_path('uploads/portfolios/' . $portfolio->image));
            }
            $portfolio->delete();
            $this->logNotification('Portfolio deleted', 'Portfolio "' . $portfolio->title . '" deleted', 'warning');
            return response()->json(['message' => 'Portfolio deleted successfully!', 'success' => true]);
        }

        if ($portfolio->image && File::exists(public_path('uploads/portfolios/' . $portfolio->image))) {
            File::delete(public_path('uploads/portfolios/' . $portfolio->image));
        }
        $portfolio->delete();
        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted successfully!');
    }
}

