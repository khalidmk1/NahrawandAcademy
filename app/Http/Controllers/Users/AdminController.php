<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class AdminController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function view_admin()
    {
        $admins =  $this->userRepository->view_admin();

        return view('Component.Profile.view.admin')->with('admins' , $admins);
    }


    public function create_admin(){

        return view('Component.Profile.create.admin');
    }

    public function store_admin(Request $request){

        return $this->userRepository->store_admin($request);

      

    }


    public function delete_admin(Request $request , String $id)
    {
        $this->userRepository->delet_profile($request, $id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Un utilisateur administratif a été supprimé');
        }else{
            return redirect()->back()->with('faild' , 'Le mot de passe que vous avez fourni est incorrect.');
        }

    }

    
}
