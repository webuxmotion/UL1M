<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\Workshop;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $query = Part::with('workshop');

        // Filter by workshop for workshop admins
        if (auth()->user()->isWorkshopAdmin()) {
            $query->where('workshop_id', auth()->user()->workshop_id);
        }

        $parts = $query->paginate(15);
        return view('admin.parts.index', compact('parts'));
    }

    public function create()
    {
        $workshops = $this->getAvailableWorkshops();
        return view('admin.parts.create', compact('workshops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'manufacturer' => 'nullable|string',
            'part_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quantity' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'workshop_id' => 'required|exists:workshops,id',
        ]);

        // Check permission
        if (!auth()->user()->canManageWorkshop($validated['workshop_id'])) {
            abort(403, 'Unauthorized action.');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/parts'), $filename);
            $validated['image'] = 'storage/parts/' . $filename;
        }

        Part::create($validated);

        return redirect()->route('admin.parts.index')
            ->with('success', 'Part created successfully.');
    }

    public function edit(Part $part)
    {
        // Check permission
        if (!auth()->user()->canManageWorkshop($part->workshop_id)) {
            abort(403, 'Unauthorized action.');
        }

        $workshops = $this->getAvailableWorkshops();
        return view('admin.parts.edit', compact('part', 'workshops'));
    }

    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'manufacturer' => 'nullable|string',
            'part_number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_image' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'workshop_id' => 'required|exists:workshops,id',
        ]);

        // Check permission
        if (!auth()->user()->canManageWorkshop($validated['workshop_id'])) {
            abort(403, 'Unauthorized action.');
        }

        // Handle image deletion
        if ($request->has('delete_image') && $request->delete_image) {
            if ($part->image && file_exists(public_path($part->image))) {
                unlink(public_path($part->image));
            }
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($part->image && file_exists(public_path($part->image))) {
                unlink(public_path($part->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/parts'), $filename);
            $validated['image'] = 'storage/parts/' . $filename;
        }

        $part->update($validated);

        return redirect()->route('admin.parts.index')
            ->with('success', 'Part updated successfully.');
    }

    public function destroy(Part $part)
    {
        // Check permission
        if (!auth()->user()->canManageWorkshop($part->workshop_id)) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image file if exists
        if ($part->image && file_exists(public_path($part->image))) {
            unlink(public_path($part->image));
        }

        $part->delete();

        return redirect()->route('admin.parts.index')
            ->with('success', 'Part deleted successfully.');
    }

    private function getAvailableWorkshops()
    {
        if (auth()->user()->isSuperAdmin()) {
            return Workshop::all();
        }

        return Workshop::where('id', auth()->user()->workshop_id)->get();
    }
}
