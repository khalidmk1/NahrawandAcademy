<?php

namespace App\Http\Controllers\Fileter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class SousCategoryController extends Controller
{
      
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create_souscategory()
    {
        $souscategories = $this->userRepository->create_souscategory();

        return view('filtering.create.sous_categorie')->with('souscategories' , $souscategories);
    }

    public function store_souscategorie(Request $request)
    {
        $categorie = $this->userRepository->store_souscategory($request);

        return redirect()->back()->with('status' , 'Vous avez Crée une SousCtagorie');
    }

    public function update_souscategory(Request $request,String $id)
    {
        $souscategory = $this->userRepository->update_souscategory($request , $id);

        return redirect()->back()->with('status' , 'Vous Avez Modifier le Categorie');
    }

    //delete SubCategory
    public function delete_souscategory(Request $request ,String $id){
        return $this->userRepository->delete_souscategory($request , $id);
    }

    //restore SubCategory
    public function restore_history_subcategory(String $id){
        return $this->userRepository->restore_history_subcategory($id);
    }

    public function search_souscategory(Request $request)
    {
        return $this->userRepository->search_filtter($request);
    }


}
