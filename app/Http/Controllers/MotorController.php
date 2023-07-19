<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobilRequest;
use App\Http\Requests\MotorRequest;
use App\Interfaces\KendaraanRepositoryInterface;
use App\Interfaces\MotorRepositoryInterface;
use App\Models\Kendaraan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;

class MotorController extends Controller
{
    private MotorRepositoryInterface $motorRepository;
    private $title = 'motor';
    public function __construct(MotorRepositoryInterface $MotorRepository)
    {
        $this->middleware('api');
        $this->motorRepository = $MotorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->motorRepository->getAllMotors();
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MotorRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function store(MotorRequest $req): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->motorRepository->createMotor($req->validated());
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
            $data = $this->motorRepository->getMotorById($id);
            return getResponseData('Success', true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MotorRequest  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MotorRequest $req, $id): JsonResponse
    {
        $session = mongoTransaction();
        $session->startTransaction();
        try {
            $data = $this->motorRepository->updateMotor($id, $req->validated());
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
            $data = $this->motorRepository->deleteMotor($id);
            $session->commitTransaction();
            return getResponseData("Success delete data of $this->title", true, $data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            $session->abortTransaction();
            return getThrowCatch($th->getMessage(), $th->getTrace(), Response::HTTP_BAD_REQUEST);
        }
    }
}
