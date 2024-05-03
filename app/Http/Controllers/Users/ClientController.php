<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class ClientController extends Controller
{
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    //crud client
    public function view_client(){
        return $this->userRepository->view_client();
    }

    public function detail_client(String $id){
        return $this->userRepository->detail_client($id);
    }
   
}
