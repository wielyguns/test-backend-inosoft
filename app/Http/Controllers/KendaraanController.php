<?php

namespace App\Http\Controllers;

use App\Http\Requests\KendaraanRequest;
use App\Interfaces\KendaraanRepositoryInterface;
use App\Services\KendaraanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KendaraanController extends Controller
{
    private KendaraanRepositoryInterface $kendaraanRepository;

    private $title = 'kendaraan';
    public function __construct(KendaraanRepositoryInterface $KendaraanRepository)
    {
        $this->middleware('api');
        $this->kendaraanRepository = $KendaraanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->kendaraanRepository->getAllKendaraans();
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  KendaraanRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function store(KendaraanRequest $req, KendaraanService $service): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->kendaraanRepository->createKendaraan($req->validated());
            $service->savePivot(request('type'), request('kendaraanable_id'), $data);
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
            $with = [
                'kendaraanable'
            ];
            $data = $this->kendaraanRepository->getKendaraanById($id, $with);
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KendaraanRequest $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KendaraanRequest $req, KendaraanService $service, $id): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->kendaraanRepository->updateKendaraan($id, $req->validated());
            $service->savePivot(request('type'), request('kendaraanable_id'), $data);
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
            $data = $this->kendaraanRepository->deleteKendaraan($id);
            $session->commitTransaction();
            return getResponseData("Success delete data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }
}
