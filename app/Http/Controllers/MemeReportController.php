<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\MemeReportRequest;

class MemeReportController extends Controller
{
    private $repository;

    public function __construct(MemeIRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource for user.
     *
     * @param int user_id
     * @return \Illuminate\Http\Response
     */
    public function indexForUser($user_id)
    {
        try
        {
            $memeReports = $this->repository->getMemeReportsForUser($user_id);
            return view('meme.reports', $memeReports);
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * Display a listing of the resource for user.
     *
     * @param int @meme_id
     * @return \Illuminate\Http\Response
     */
    public function indexForMeme($meme_id)
    {
        try
        {
            $memeReports = $this->repository->getMemeReports($meme_id);
            return view('meme.reports', $memeReports);
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meme.report.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MemeReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemeReportRequest $request)
    {
        try
        {
            $validated = $request->validated();
            if ($this->repository->addMemeReport($validated))
            {
                Session::flash('alert-success', 'success');
            }
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to report meme: ', $exception->getMessage(), "\n";
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroyForUser($user_id)
    {
        try
        {
            $this->repository->deleteMemeReportsForUser($user_id);
            Session::flash('alert-success', 'success');
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete meme reports for user: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $meme_id
     * @return \Illuminate\Http\Response
     */
    public function destroyForMeme($meme_id)
    {
        try
        {
            $this->repository->deleteMemeReports($meme_id);
            Session::flash('alert-success', 'success');
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete meme reports: ', $exception->getMessage(), "\n";
        }
    }
}
