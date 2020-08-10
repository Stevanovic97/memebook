<?php

namespace App\Http\Controllers;

use Session;
use App\Http\Requests\MemeRequest;
use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\CommentIRepository;

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
        try
        {
            // $comments = $this->commentRepository->getComments($meme_id);
            $memes = $this->memeRepository->getAllMemes()->reverse();
            $categories = $this->categoryRepository->getCategories();

            return view('meme.show')->with(compact('memes', 'categories'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get memes: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Display a listing of the resource for the user.
     *
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function indexForUser($user_id)
    {
        try
        {
            $memes = $this->memeRepository->getAllMemesForUser($user_id);
            if (!isset($memes))
                abort(404);

            return view('meme.show')->with(compact('memes'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get memes for user: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Display a listing of the resource for the user.
     *
     * @param int $meme_id
     * @return \Illuminate\Http\Response
     */
    public function getMeme($meme_id)
    {
        try
        {
            $meme = $this->memeRepository->getMeme($meme_id);
            if (!isset($meme))
                abort(404);

            return view('meme.show')->with(compact('meme'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get meme: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategories();
        return view('meme.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\MemeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemeRequest $request)
    {
        try
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
        catch (Exception $exception)
        {
            echo 'Error while trying to add meme: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($meme_id)
    {
        try
        {
            $meme = $this->memeRepository->getMeme($meme_id);
            if (!isset($meme))
                abort(404);

            return view('meme.edit')->with(compact('meme'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get meme: ', $exception->getMessage(), "\n";
        }
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
        try
        {
            $validated = $request->validated();
            $this->memeRepository->updateMeme($request, $meme_id);
            Session::flash('alert-success', 'success');

            return redirect(route('memes.index'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to update meme: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $meme_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($meme_id)
    {
        try
        {
            $this->memeRepository->deleteMeme($meme_id);
            Session::flash('alert-success', 'success');

            return redirect(route('memes.index'));
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete meme: ', $exception->getMessage(), "\n";
        }
    }
}
