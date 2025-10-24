<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::with(['admin', 'city'])->paginate(15);
        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        $admins = User::where('role', 'workshop_admin')->get();
        $cities = City::orderBy('name')->get();
        return view('admin.workshops.create', compact('admins', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:workshops',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'phone' => 'required|string',
            'admin_id' => 'nullable|exists:users,id',
        ]);

        Workshop::create($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop created successfully.');
    }

    public function edit(Workshop $workshop)
    {
        $admins = User::where('role', 'workshop_admin')->get();
        $cities = City::orderBy('name')->get();
        return view('admin.workshops.edit', compact('workshop', 'admins', 'cities'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:workshops,name,' . $workshop->id,
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'phone' => 'required|string',
            'admin_id' => 'nullable|exists:users,id',
        ]);

        $workshop->update($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop updated successfully.');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop deleted successfully.');
    }
}
