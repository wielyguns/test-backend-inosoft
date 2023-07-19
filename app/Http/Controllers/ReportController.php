<?php

namespace App\Http\Controllers;

use App\Interfaces\PenjualanRepositoryInterface;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    private PenjualanRepositoryInterface $penjualanRepository;
    private $title = 'report';
    public function __construct(PenjualanRepositoryInterface $PenjualanRepository)
    {
        $this->middleware('api');
        $this->penjualanRepository = $PenjualanRepository;
    }
    /**
     * Display a listing of the resource.
     * @param ReportService $report
     * @param Request $req
     * @return \Illuminate\Http\Response
     */
    function index(ReportService $report, Request $req): JsonResponse
    {
        try {
            $with = [
                'kendaraan.kendaraanable'
            ];

            $data['list'] = $this->penjualanRepository->paginatePenjualanWithEloquent($with, $report->where($req));

            $data['pendapatan'] = $report->pendapatan();

            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
