<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RepositoryInterface\apiRepositoryInterface;

class GoalController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }

    public function getGoals()
    {
        return $this->apiRepository->getGoals();
    }

    public function UserObjectif(Request $request , $id , $goal)
    {
        return $this->apiRepository->UserObjectif($request , $id , $goal);
    }

    public function CoursGoal(String $id){
        return $this->apiRepository->CoursGoal($id);
    }

    //get goals par domain
    public function domain()
    {
        return  $this->apiRepository->domain();
    }

   
}
