<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Interfaces\PenjualanRepositoryInterface;
use App\Services\PenjualanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenjualanController extends Controller
{
    private PenjualanRepositoryInterface $penjualanRepository;

    private $title = 'penjualan';
    public function __construct(PenjualanRepositoryInterface $PenjualanRepository)
    {
        $this->middleware('api');
        $this->penjualanRepository = $PenjualanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->penjualanRepository->getAllPenjualans();
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PenjualanRequest  $req
     * @param  PenjualanService  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanRequest $req, PenjualanService $penjualan): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->penjualanRepository->createPenjualan($penjualan->data($req->validated()));
            $session->commitTransaction();
            return getResponseData("Success store data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            $where = [
                'kendaraan.kendaraanable'
            ];
            $data = $this->penjualanRepository->getPenjualanById($id, $where);
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PenjualanRequest  $req
     * @param  PenjualanService  $penjualan
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenjualanRequest $req, PenjualanService $penjualan, $id): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->penjualanRepository->updatePenjualan($id, $penjualan->data($req->validated()));
            $session->commitTransaction();
            return getResponseData("Success update data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->penjualanRepository->deletePenjualan($id);
            $session->commitTransaction();
            return getResponseData("Success delete data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }
}
