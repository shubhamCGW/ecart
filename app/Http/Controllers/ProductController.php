<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'name' => 'required|string|max:256',
                    'price' => 'required|numeric|',
                    'sub_desc' => 'required|string',
                    'description'=>'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]
            );
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }

        DB::transaction(function () use (&$request) {
            $product = new Product();
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->sub_desc = $request->input('sub_desc');
            $product->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/products/');
                $image->move($destinationPath, $filename);
                $imagePath = url('images/products/'.$filename);
                $product->image = $imagePath;

            }
            $product->category_id = $request->input('category_id');
            $product->save();
            }
        );

        return redirect()->route('product.index')->with('success','Product created successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $product = Product::find($id);
        try {
            $this->validate(
                $request,
                [
                    'name' => 'required|string|max:256',
                    'price' => 'required|numeric|',
                    'sub_desc' => 'required|string',
                    'description'=>'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'category_id' => 'required',
                ]
            );
        } catch (ValidationException $e) {

            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }

        DB::transaction(function () use (&$request,$product) {
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->sub_desc = $request->input('sub_desc');
            $product->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/products/');
                $image->move($destinationPath, $filename);
                $imagePath = url('images/products/'.$filename);
                $product->image = $imagePath;

            }
            else {
                $product->image;
            }
            $product->category_id = $request->input('category_id');
            $product->save();
            }
        );

        return redirect()->route('product.index')
        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
        ->with('success','Product deleted successfully');
    }
}
