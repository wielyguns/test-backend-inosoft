<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobilRequest;
use App\Interfaces\KendaraanRepositoryInterface;
use App\Interfaces\MobilRepositoryInterface;
use App\Models\Kendaraan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;

class MobilController extends Controller
{
    private MobilRepositoryInterface $mobilRepository;
    private $title = 'mobil';
    public function __construct(MobilRepositoryInterface $MobilRepository)
    {
        $this->middleware('api');
        $this->mobilRepository = $MobilRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->mobilRepository->getAllMobils();
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MobilRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function store(MobilRequest $req): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->mobilRepository->createMobil($req->validated());
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
            $data = $this->mobilRepository->getMobilById($id);
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MobilRequest $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MobilRequest $req, $id): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->mobilRepository->updateMobil($id, $req->validated());
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
            $data = $this->mobilRepository->deleteMobil($id);
            $session->commitTransaction();
            return getResponseData("Success delete data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }
}
