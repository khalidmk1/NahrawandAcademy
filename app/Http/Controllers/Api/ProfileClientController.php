<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\apiRepositoryInterface;

class ProfileClientController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }



    public function getClientById( String $id)
    {
        return $this->apiRepository->getClientById($id);
    }

    public function update_client(Request $request , String $id){
        return  $this->apiRepository->update_client($request , $id);
    } 
    
    public function update_image_client(Request $request , String $id){
        return  $this->apiRepository->update_image_client($request , $id);
    }

    //client password
    public function password_update(Request $request ){
        return  $this->apiRepository->password_update($request);
    }

    public function populaire_speaker(){
        return  $this->apiRepository->populaire_speaker();
    }


}
