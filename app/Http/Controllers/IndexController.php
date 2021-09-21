<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(Request $request){
        $model = new Image();
        $search = $request->input('search');
        if($search == '')
            $images = $model->latest()->paginate(32);
        else
            $images = $model->where('user_id', auth()->user()->id)->where('name', 'LIKE', "%$search%")->orderByDesc('updated_at')->paginate(32);

        return view('index.welcome',compact('images'))
        ->with('i', (request()->input('page', 1) - 1) * 32);
    }

    public function show(Request $request)
    {
        $images = Image::findOrFail($request['search']);
        $tags = explode(',', $images->keywords) ;
        return view('index.show',compact('images', 'tags'));
    }
}
