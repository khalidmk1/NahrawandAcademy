<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class ReportController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(){
        return $this->userRepository->reportindex();
    }

    public function authCount()
    {
        return $this->userRepository->ReportCount();
    }
    
    public function FilterCount(Request $request)
    {
        return $this->userRepository->FilterCount($request);
    }

    // progress of user in the cours
    public function view_video(String $user , String $cour){
        return $this->userRepository->view_video($user , $cour); 
    }
    
}
