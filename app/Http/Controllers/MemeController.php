<?php

namespace App\Http\Controllers;

use Session;
use App\Meme;
use App\ImageHelper;
use App\MessageHelper;
use App\MemeBookConstants;
use Illuminate\Http\Request;
use App\Http\Requests\MemeRequest;
use App\Http\Requests\VoteRequest;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemeController extends MemeBookBaseController
{
    public function index()
    {
        $memes = $this->memeRepository->getAllMemes();
        $categories = $this->categoryRepository->getCategories();
        $reasonsToReport = MemeBookConstants::$reasonsToReport;

        return view('index')->with(compact('memes', 'categories', 'reasonsToReport'));
    }

    public function categoryIndex($category_id)
    {
        if (isset($category_id))
        {
            $memes = $this->memeRepository->getAllMemesForCategory($category_id);
            $categories = $this->categoryRepository->getCategories();
            $reasonsToReport = MemeBookConstants::$reasonsToReport;

            return view('meme.show')->with(compact('memes', 'categories', 'reasonsToReport'));
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function singleMeme($meme_id)
    {
        if (isset($meme_id))
        {
            try
            {
                $meme = $this->memeRepository->getMeme($meme_id);
                $reasonsToReport = MemeBookConstants::$reasonsToReport;
    
                return view('meme.single')->with(compact('meme', 'reasonsToReport'));
            }
            catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
            {
                $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
                return back()->with($message);
            }
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function create()
    {
        try 
        {
            $apiData = json_decode(file_get_contents('https://api.imgflip.com/get_memes'), true);
            $apiMemeImages = $apiData['data']['memes'];
            $categories = $this->categoryRepository->getCategories();

            return view('meme.create', compact('apiMemeImages', 'categories'));
        }
        catch (Exception $ex)
        {
            \Debugbar::addThrowable($ex);
            Log::error($ex->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), MemeRequest::rules());
        if ($validator->fails()) {
            $message = MessageHelper::ToastMessage('danger', true, $validator->messages()
                                                                             ->first());
            return back()->withInput()->with($message);
        }

        if ($request->ajax()) {
            $message = $this->memeRepository->addApiMeme($request);
            return response()->json(['url' => route('memes.index')]);
        }
        
        if ($request->hasFile('image')) {
            $img_name = ImageHelper::CreateImage($request->file('image'), 'images/memes');
            $message = $this->memeRepository->addMeme($request, $img_name);
        }
        return redirect(route('memes.index'))->with($message);
    }

    public function edit($meme_id)
    {
        if (isset($meme_id))
        {
            $meme = $this->memeRepository->getMeme($meme_id);
            return view('meme.edit')->with(compact('meme'));
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function update(Request $request, $meme_id)
    {
        if (isset($meme_id))
        {
            $validator = Validator::make($request->all(), MemeRequest::rules());
            if ($validator->fails()) {
                $message = MessageHelper::ToastMessage('danger', true, $validator->messages()
                                                                                 ->first());
                return back()->withInput()->with($message);
            }
            $message = $this->memeRepository->updateMeme($request, $meme_id);
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function deleteMeme(Request $request)
    {
        if (isset($request->meme_id))
        {
            try
            {
                $message = $this->memeRepository->deleteMeme($request->meme_id);
                return redirect(route('memes.index'))->with($message);
            }
            catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
            {
                $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
                return back()->with($message);
            }
        }
        else 
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function vote(Request $request)
    {
        $validator = Validator::make($request->all(), VoteRequest::rules());
        if ($validator->fails()) 
        {
            $message = MessageHelper::ToastMessage('danger', true, $validator->messages()
                                                                             ->first());
            return response()->json($message, Response::HTTP_BAD_REQUEST);
        }
        if (Auth::user()->id)
        {
            $createdVote = $this->voteRepository->voteMeme($request->meme_id, Auth::user()->id, $request->vote);
            return $createdVote;
        }
    }

    public function reportMeme(Request $request)
    {
        $validator = Validator::make($request->all(), ReportRequest::rules());
        if ($validator->fails()) 
        {
            $message = MessageHelper::ToastMessage('danger', true, $validator->messages()
                                                                             ->first());
            return back()->withInput()->with($message);
        }

        $message = $this->memeReportRepository->addMemeReport($request, Auth::user()->id);
        return back()->withInput()->with($message);
    }
}
