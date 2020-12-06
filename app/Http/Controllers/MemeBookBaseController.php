<?php

namespace App\Http\Controllers;

use App\Repository\IRepositories\MemeIRepository;
use App\Repository\IRepositories\UserIRepository;
use App\Repository\IRepositories\CategoryIRepository;
use App\Repository\IRepositories\VoteIRepository;
use App\Repository\IRepositories\EditRequestIRepository;
use App\Repository\IRepositories\MemeReportIRepository;
use Illuminate\Support\Facades\Response;

abstract class MemeBookBaseController extends Controller
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

     /**
     * Make standard response with some data
     *
     * @param object|array $data Data to be send as JSON
     * @param int $code optional HTTP response code, default to 200
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithData($data, $code = 200)
    {
        return Response::json([
            'success' => true,
            'data' => $data
        ], $code);
    }


    /**
     * Make standard successful response ['success' => true, 'message' => $message]
     *
     * @param string $message Success message
     * @param int $code HTTP response code, default to 200
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess($message = 'Done!', $code = 200)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], $code);
    }

    /**
     * Make standard response with error ['success' => false, 'message' => $message]
     *
     * @param string $message Error message
     * @param int $code HTTP response code, default to 500
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError($message = 'Server error', $code = 500)
    {
        return Response::json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}
