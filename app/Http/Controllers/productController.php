<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class productController extends Controller
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
        $products = product::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get()??[];
        
        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.add-product');
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'pname' => 'required|string|unique:products',
            'description' => ['nullable', 'max:255'],
            'amount' => 'integer',
        ],
        ['pname.unique' => 'The product name has already been taken.',]

    );

        $product = new product;
        //$category = new Category;
        $product->pname = $request->input('pname');
        $product->description = $request->input('description');
        $product->amount = $request->input('amount');
        $product->price = $request->input('price');



        $product->user_id = Auth::user()->id;

        $product->save();

        //$product->category()->attach($request->input('category'));
        //$product->category()->attach(Category::where('category_name', $request->input('category')));
        if($request->input('type')==0)
        {
        return back()->with('success', 'Product created successfully');
        }
        else
        {
            return redirect()->route('home')->with('success', 'Product added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::user()->id)->first();
        return view('layouts.delete-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('layouts.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'pname' => 'required|string|unique:products',
            'description' => 'nullable',
            'amount' => 'integer',
        ],
        ['pname.unique' => 'The product name has already been taken.',]);

        $product = product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $category = Category::where('category_name', '=', $request->input('category'))->first();
        $product->pname = $request->input('pname');
        $product->description = $request->input('description');
        $product->amount = $request->input('amount');
        $product->price = $request->input('price');

        $product->user_id = Auth::user()->id;

        $product->save();
        
        $product->categories()->attach($category->id);
        return back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $product->delete();
        return redirect()->route('home')->with('success', 'Product deleted successfully');
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('categories')
                ->where('category_name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach($data as $row)
            {
                $output .= '
                <li><a class="dropdown-item" href="#">'.$row->category_name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
