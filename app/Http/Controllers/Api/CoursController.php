<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\apiRepositoryInterface;

class CoursController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }

    //all cours 
    public function allCours(){
        return $this->apiRepository->allCours();
    }

 
     //all short cours by goals
     public function CourShort(String $user){
        return $this->apiRepository->CourShort($user);
    }

    //create personel cours
    public function personelCours(String $user , String $cour){
        return $this->apiRepository->personelCours($user , $cour);
    }

    //get personel cours 
    public function getpersonelCours(String $user){
        return $this->apiRepository->getpersonelCours($user);
    }

    //create personel video podcast
    public function personelvideoPodcast(String $user , String $video){
        return $this->apiRepository->personelvideoPodcast($user , $video);
    }

    // personel video formation
    public function personelvideoFormation(String $user , String $video){
        return $this->apiRepository->personelvideoFormation($user , $video);
    }

    public function coming_cours(){
        return  $this->apiRepository->coming_cours();
    }

    public function Cour_Conference()
    {
        return  $this->apiRepository->Cour_Conference();
    }
    public function Cour_Podcast()
    {
        return  $this->apiRepository->Cour_Podcast();
    }

    public function Cour_Formation()
    {
        return  $this->apiRepository->Cour_Formation();
    }
    
    //Qsm formation
    public function Cour_Fourmation_Qsm(String $id)
    {
        return  $this->apiRepository->Cour_Fourmation_Qsm($id);
    }

    //create question answer for user
    public function user_answer(Request $request ,String $user , String $cour , String $questionId){
        return  $this->apiRepository->user_answer($request ,$user , $cour , $questionId);
    }

    //tree cours get

    public function treeCoursFormation(String $user){
        return  $this->apiRepository->treeCoursFormation($user);
    }

    public function podcastgoals(String $user)
    {
        return  $this->apiRepository->podcastgoals($user);
    }
    
   

    public function Cour_Formation_detail(String $id)
    {
        return  $this->apiRepository->Cour_Formation_detail($id);
    }

    // cour Favoris
    public function Cour_Favoris(String $id , String $cour){
        return  $this->apiRepository->Cour_Favoris($id , $cour);
    }
    //all favoris
    public function AllFavoris(String $id){
        return  $this->apiRepository->AllFavoris($id);
    }

     //Cours Comment
     public function CoursComment(String $id , String $cours , Request $request){
        return  $this->apiRepository->CoursComment($id , $cours , $request);
     }

     //get Comment
     public function getComment(String $cours)
     {
        return $this->apiRepository->getComment($cours);
     }
}
