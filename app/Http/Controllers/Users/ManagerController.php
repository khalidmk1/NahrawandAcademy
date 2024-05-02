<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class ManagerController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function view_manager()
    {
        $managers = $this->userRepository->view_manager();

        return view('Component.Profile.view.manager')->with('managers' , $managers);
    }


    public function create_manager(){

        $roles = $this->userRepository->create_manger();

        return view('Component.Profile.create.manager')->with('roles' , $roles);
    }

    public function delete_manager(Request $request , String $id)
    {
        $this->userRepository->delet_profile($request, $id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Un utilisateur manager a été supprimé');
        }else{
            return redirect()->back()->with('faild' , 'Le mot de passe que vous avez fourni est incorrect.');
        }

    }

    public function store_manager(Request $request){
    
        return $CreateManger = $this->userRepository->store_manager($request);
        
    }

}
