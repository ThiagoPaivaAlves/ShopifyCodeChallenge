<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $model = new Image();
        $search = $request->input('search');
        if($search == '')
            //$images = Image::where('user_id', auth()->user()->id)->orderByDesc('updated_at')->paginate(10);
            $images = $model->where('user_id', auth()->user()->id)->orderByDesc('updated_at')->paginate(10);
        else
            //$images = Image::where(['user_id', auth()->user()->id], ['nome', $search] )->orderByDesc('updated_at')->paginate(10);
            $images = $model->where('user_id', auth()->user()->id)->where('name', 'LIKE', "%$search%")->orderByDesc('updated_at')->paginate(10);

        return view('images.index',compact('images'))
        ->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'keywords' => 'required',
            'price' => 'required|numeric|between:0,9999.99',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $input['user_id'] = auth()->user()->id;
        Image::create($input);

        return redirect()->route('images.index')
        ->with('success','Image saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
        if($image['user_id'] != auth()->user()->id)
            return redirect()->route('images.index')
            ->with('error','Invalid image link.');

        return view('images.show',compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
        if($image['user_id'] != auth()->user()->id)
            return redirect()->route('images.index')
            ->with('error','Invalid image link.');

        return view('images.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'keywords' => 'required',
            'price' => 'required',
            'detail' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        else{
            unset($input['image']);
        }
        $input['user_id'] = auth()->user()->id;

        Image::create($input);

        return redirect()->route('images.index')
        ->with('success','Image saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
        if($image['user_id'] != auth()->user()->id)
            return redirect()->route('images.index')
            ->with('error','Invalid image link.');

        $image->delete();

        return redirect()->route('images.index')
        ->with('success','Image deleted successfully');
    }
}
