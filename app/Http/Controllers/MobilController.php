<?php

namespace App\Http\Controllers;

use App\Interfaces\MobilRepositoryInterface;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    private MobilRepositoryInterface $mobilRepository;
    
    public function __construct(MobilRepositoryInterface $MobilRepository)
    {
        $this->middleware('auth:api');
        $this->mobilRepository = $MobilRepository;
    }
}
