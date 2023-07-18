<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorRequest;
use App\Interfaces\MotorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MotorController extends Controller
{
    private MotorRepositoryInterface $motorRepository;

    public function __construct(MotorRepositoryInterface $MotorRepository)
    {
        $this->middleware('auth:api');
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
            return getThrowCatch($th->getMessage(), $th->getTrace(), $th->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MotorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotorRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
        });
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
