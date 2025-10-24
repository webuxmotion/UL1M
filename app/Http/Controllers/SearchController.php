<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $parts = Part::with(['workshop.city'])
            ->when($search, function ($query) use ($search) {
                $query->search($search);
            })
            ->orderBy('workshop_id')
            ->get();

        // Group parts by workshop
        $groupedParts = $parts->groupBy('workshop_id');

        return view('search.index', compact('groupedParts', 'search'));
    }

    public function show(Part $part)
    {
        $part->load(['workshop.city']);
        return view('search.show', compact('part'));
    }
}
