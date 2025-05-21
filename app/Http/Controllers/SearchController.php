<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;

class SearchController extends Controller
{
    /**
     * Search the specified resource - search option
     */
    public function search(Request $request): View
    {
        // get search term
        $searchTerm = strtolower($request->get('search_term'));

        // start query search
        $query = Project::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw("LOWER(title) like ?", ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(requirements) like ?', ['%' . $searchTerm . '%']);
            });
        }

        // results
        $openProjects = $query->latest()->paginate(12)->appends(['search_term' => $searchTerm]);

        // display/return view
        return view('projects.index')->with('openProjects', $openProjects);
    }
}
