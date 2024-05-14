<?php

namespace App\Http\Controllers\Fileter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;


class CategoriesController extends Controller
{
    
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }


    public function create_category()
    {

        $categories = $this->userRepository->create_category();


        return view('filtering.create.categorie')->with('categories' , $categories);
    }

    public function store_category(Request $request)
    {

        $category = $this->userRepository->store_category($request);

        return redirect()->back()->with('status' , 'Vous Avez Crée Categorie');


    }

    public function update_category(Request $request,String $id)
    {
       $category = $this->userRepository->update_category($request , $id);

        return redirect()->back()->with('status' , 'Vous Avez Modifier le Categorie');
    }


    public function delete_category(Request $request ,String $id)
    {
        return  $this->userRepository->delete_category($request , $id);
    }

    public function search_categorie(Request $request)
    {
        return  $this->userRepository->search_filtter($request);
    }


}
