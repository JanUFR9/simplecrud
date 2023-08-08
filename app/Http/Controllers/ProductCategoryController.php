<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
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
        $productcategories = ProductCategory::orderBy('created_at', 'desc')->get()??[];
        return view('home', compact('productcategories'));
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
            'name' => 'required|string',
            
        ]);

        $category = new category;
        $category->name = $request->input('name');

        $category->category_id = Auth::category()->id;

        $category->save();
        return back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = category::where('id', $id)->where('category_id', Auth::category()->id)->first();
        return view('layouts.delete-category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = category::where('id', $id)->where('category_id', Auth::category()->id)->firstOrFail();
        return view('layouts.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $category = category::where('id', $id)->where('category_id', Auth::category()->id)->firstOrFail();
        $category->name = $request->input('name');

        $category->save();
        return back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::where('id', $id)->where('category_id', Auth::category()->id)->firstOrFail();
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
