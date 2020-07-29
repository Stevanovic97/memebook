<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meme;
use Image;


class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memes = Meme::all();
        if (!isset($memes))
            abort(404);

        return view('meme.show')->withMemes($memes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:30',
            'body' => 'required|max:255',
//            'image' => 'required|image'
        ));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = Image::make($file);
            $img_name = "/" . time() . "_" . $file->getClientOriginalExtension();
            $path = public_path('images/memes');
            $img->save($path . $img_name);
        }


        $meme = Meme::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $img_name
        ]);

        return redirect(route('memes.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);
        $meme = Meme::find($id);
//        dd($meme);
        $meme->delete();
        return redirect(route('memes.index'));
    }
}
