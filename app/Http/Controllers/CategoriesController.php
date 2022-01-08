<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
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
        $categories = Category::all();
        return view('category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
                    'name' => 'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                ]
            );
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }
        DB::transaction(function () use (&$request) {
            $Category = new Category();
            $Category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/');
                $image->move($destinationPath, $filename);
                $imagePath = url('images/' . $filename);
                $Category->image = $imagePath;

            }
            $Category->save();
        }
        );

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        $products = Product::where('category_id',$category->id)->get();

        // dd($products);
        // if (is_null($category)) {
        //     return $this->sendError('Category not found.');
        // }
        return view('category.show', compact('category','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = category::findOrFail($id);
        try {
            $this->validate(
                $request,
                [
                    'name' => 'required|string|max:256',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                ]
            );
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }

        DB::transaction(function () use (&$request, $category) {
            $category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/');
                $image->move($destinationPath, $filename);
                $imagePath = url('images/' . $filename);
                $category->image = $imagePath;

            }else {
                $category->image;
            }
            $category->save();
        }
        );

        return redirect()->route('category.index')
            ->with('success', 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}
