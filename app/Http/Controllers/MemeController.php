<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Session;
use App\Http\Requests\MemeRequest;
use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\CommentIRepository;
use Illuminate\Support\Facades\Auth;


use App\Meme;
use Image;


class MemeController extends Controller
{
    private $memeRepository;
    private $categoryRepository;
    private $commentRepository;

    public function __construct(MemeIRepository $memeRepository,
                                CategoryIRepository $categoryRepository,
                                CommentIRepository $commentRepository)
    {
        $this->memeRepository = $memeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $memes = $this->memeRepository->getAllMemes();

        $categories = $this->categoryRepository->getCategories();

        return view('meme.show')->with(compact('memes', 'categories'));

    }

    public function categoryIndex($category_id)
    {
        $memes = $this->memeRepository->getAllMemesForCategory($category_id);
        $categories = $this->categoryRepository->getCategories();
        if (!isset($memes))
            abort(404);

        return view('meme.show')->with(compact('memes', 'categories'));
    }

    public function userIndex($user_id)
    {
        $memes = $this->memeRepository->getAllMemesForUser($user_id);
        $categories = $this->categoryRepository->getCategories();
        if (!isset($memes))
            abort(404);

        return view('meme.show')->with(compact('memes', 'categories'));
    }

    public function getMeme($meme_id)
    {
        $meme = $this->memeRepository->getMeme($meme_id);
        if (!isset($meme))
            abort(404);

        return view('meme.show')->with(compact('meme'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategories();
        return view('meme.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\MemeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemeRequest $request)
    {

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = Image::make($file);
            $img_name = "/" . time() . "_" . $file->getClientOriginalExtension();
            $path = public_path('images/memes');
            $img->save($path . $img_name);
        }
        $message = $this->memeRepository->addMeme($request, $img_name);

        return redirect(route('memes.index'))->with($message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($meme_id)
    {
        $meme = $this->memeRepository->getMeme($meme_id);
        if (!isset($meme))
            abort(404);

        return view('meme.edit')->with(compact('meme'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\MemeRequest $request
     * @param int $meme_id
     * @return \Illuminate\Http\Response
     */
    public function update(MemeRequest $request, $meme_id)
    {

        $validated = $request->validated();
        $this->memeRepository->updateMeme($request, $meme_id);
        Session::flash('alert-success', 'success');

        return redirect(route('memes.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $meme_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($meme_id)
    {
        $this->memeRepository->deleteMeme($meme_id);
        Session::flash('alert-success', 'success');

        return redirect(route('memes.index'));

    }
}
