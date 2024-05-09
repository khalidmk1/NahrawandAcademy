<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RepositoryInterface\apiRepositoryInterface;

class TicketController extends Controller
{

    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }


    //get user manager
    public function getmanager(){
        return $this->apiRepository->getmanager();
    }

    public function store_ticket(Request $request , String $id){
        return $this->apiRepository->store_ticket($request , $id);
    }
    public function get_ticket(String $id){
        return $this->apiRepository->get_ticket($id);
    }

    // FAQ
    public function FAQ(){
        return $this->apiRepository->FAQ();
    }
}
