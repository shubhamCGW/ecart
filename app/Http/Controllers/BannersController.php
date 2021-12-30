<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
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
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                    ]
            );
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }
        DB::transaction(function () use (&$request) {
            $Banner = new Banner();
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/');
                $image->move($destinationPath, $filename);
                $imagePath = url('images/'.$filename);
                $Banner->image = $imagePath;

            }
            $Banner->save();
            }
        );
        return redirect()->route('banner.index')->with('success', 'Your images has been upload successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $Banner = Banner::findOrFail($id);

        try {
            $this->validate(
                $request,
                [
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|'
                        . 'dimensions:max_width=1920,max_height=1080',
                ]
            );
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withErrors($e->validator->getMessageBag()->toArray())
                ->withInput();
        }

        DB::transaction(function () use (&$request, &$Banner) {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('/public/images/');
                $image->move($destinationPath, $filename);
                $imagePath = 'images/'.$filename;
                $Banner->image = $imagePath;

            }
            else {
                $Banner->image;
            }
            $Banner->save();
            }
        );
        return redirect()->route('banner.index')->with('success', 'Your images has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Banner = Banner::findOrFail($id);

        $Banner->delete();

        return redirect()->route('banner.index');
    }
}
