<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get()??[];
        return view('home', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    
        $this->validate($request, [
            'category_name' => 'required|string|unique:categories',
            
        ]);

        $category = new category;
        $category->category_name = $request->input('category_name');

        

        $category->save();
        if($request->input('type')==0)
        {
        return back()->with('success', 'Category created successfully');
        }
        else
        {
            return redirect()->route('categories')->with('status', 'Category added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = category::where('id', $id)->first();
        return view('layouts.delete-category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = category::where('id', $id)->firstOrFail();
        return view('layouts.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'category_name' => 'required|string|unique:categories',
        ]);

        $category = category::where('id', $id)->firstOrFail();
        $category->category_name = $request->input('category_name');

        $category->save();
        return back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::where('id', $id)->firstOrFail();
        $category->delete();
        return redirect()->route('categories')->with('status', 'Category deleted successfully');
    }
}
