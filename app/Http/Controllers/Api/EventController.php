<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\apiRepositoryInterface;
use App\RepositoryInterface\UsersRepositoryInterface;

class EventController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }


    public function create_event(){
        return $this->userRepository->create_event();
    }

    public function store_event(Request $request){
        return $this->userRepository->store_event($request);
    }

    //GetEvent
    public function event(){
        return $this->apiRepository->event();
    }

}
