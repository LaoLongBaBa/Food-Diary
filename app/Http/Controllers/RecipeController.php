<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get auth user
        $user = Auth::user();
        // get all recipes by user
        $recipes = $user->recipes()->get()->toArray();
        // Get all dates in recipes
        $dates = array_column($recipes, 'date');
        // Use date as key and recipes as value
        $recipes = array_column($recipes, null, 'date');
        // Inertia return view
        return Inertia::render('Recipes/Index', [
            'content' => $recipes,
            'dates'   => $dates,
            'selectedDate' => $dates[0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Recipes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'date' => 'required',
            'breakfast' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
        ]);
        // get auth user
        $user = Auth::user();
        // save date,breakfase,lunch,dinner
        $user->recipes()->create([
            'date' => $request->date,
            'breakfast' => $request->breakfast,
            'lunch' => $request->lunch,
            'dinner' => $request->dinner,
        ]);
        // redirect back with success message
        return redirect()->back()->with('success', 'Recipe created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        // Inertia return view
        return Inertia::render('Recipes/Edit', [
            'recipe' => $recipe
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // validate request
        $request->validate([
            'date' => 'required',
            'breakfast' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
        ]);
        // update date,breakfast,lunch,dinner
        $status = $recipe->update([
            'date' => $request->date,
            'breakfast' => $request->breakfast,
            'lunch' => $request->lunch,
            'dinner' => $request->dinner,
        ]);
        // redirect back with success message
        return redirect()->back()->with(['success' => 'Recipe updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->back()->with('success', 'Recipe deleted.');
    }
}
