<?php

namespace App\Http\Controllers;

use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\UserIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\VoteIRepository;
use App\Repository\IRepositories\EditRequestIRepository;
use App\Repository\IRepositories\MemeReportIRepository;

class MemeBookBaseController extends Controller
{
    protected $memeRepository;
    protected $userRepository;
    protected $categoryRepository;
    protected $voteRepository;
    protected $editRequestRepository;
    protected $memeReportRepository;

    public function __construct(UserIRepository $userRepository,
                                MemeIRepository $memeRepository,
                                CategoryIRepository $categoryRepository,
                                VoteIRepository $voteRepository,
                                EditRequestIRepository $editRequestRepository,
                                MemeReportIRepository $memeReportRepository)
    {
        $this->memeRepository = $memeRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->voteRepository = $voteRepository;
        $this->editRequestRepository = $editRequestRepository;
        $this->memeReportRepository = $memeReportRepository;
    }
}
