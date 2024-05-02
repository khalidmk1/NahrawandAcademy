<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;


class SpeakersController extends Controller 
{
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function view_speakers()
    {
        $speakers = $this->userRepository->view_speaker();

        return view('Component.Profile.view.spearkers')->with('speakers' , $speakers);
    }

    public function create_speakers(){

        $SpeakerPolicy = $this->userRepository->create_speakers();


        if($SpeakerPolicy['rolePermissionExists']){
            return view('Component.Profile.create.speakers');
        }else{
            abort(403, 'Unauthorized action.');
        }

    }

    public function store_speaker(Request $request)
    {

        return $this->userRepository->store_speaker($request);

    }

    public function delete_speaker(Request $request ,String $id)
    {

        $this->userRepository->delete_speaker($request, $id);


        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , ' Un utilisateur intervenant a été supprimé. ');
        }else{
            return redirect()->back()->with('faild' , 'Le mot de passe que vous avez fourni est incorrect.');
        }
    }

}
