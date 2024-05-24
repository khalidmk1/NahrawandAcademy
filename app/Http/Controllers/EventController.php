<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class EventController extends Controller
{
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function event(){
        return $this->userRepository->event();
    }

    public function event_show(Request $request , String $id){
        return $this->userRepository->event_show($request , $id);
    }

    public function create_event(){
        return $this->userRepository->create_event();
    }

    public function store_event(Request $request){
        return $this->userRepository->store_event($request);
    }

   
}
