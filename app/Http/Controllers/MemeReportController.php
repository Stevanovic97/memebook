<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\MemeReportRequest;

class MemeReportController extends MemeBookBaseController
{
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

    public function create()
    {
        return view('meme.report.show');
    }

    public function store(MemeReportRequest $request)
    {
        try
        {
            $validated = $request->validated();
            $created = $this->repository->addMemeReport($validated);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to report meme: ', $exception->getMessage(), "\n";
        }    
    }

    public function destroyForUser($user_id)
    {
        try
        {
            $deleted = $this->repository->deleteMemeReportsForUser($user_id);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete meme reports for user: ', $exception->getMessage(), "\n";
        }
    }

    public function destroyForMeme($meme_id)
    {
        try
        {
            $deleted = $this->repository->deleteMemeReports($meme_id);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete meme reports: ', $exception->getMessage(), "\n";
        }
    }
}
