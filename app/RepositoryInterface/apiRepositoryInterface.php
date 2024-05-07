<?php

namespace App\RepositoryInterface;

use Illuminate\Http\Request;

interface apiRepositoryInterface {
    
    //client password
    public function password_update(Request $request );

    // get client by id
    public function getClientById(String $id);
    //update client
    public function update_client(Request $request , String $id); 
    //get populaire speaker
    public function populaire_speaker(); 

    //coming soon cours
    public function coming_cours();

    //domain
    public function domain();

    //program
    public function program();
    
    //all cours
    public function allCours();

    //create personel cours
    public function personelCours(String $user , String $cour);
    //get personel cours 
    public function getpersonelCours(String $user);

    //personel video podcast
    public function personelvideoPodcast(String $user , String $video);
    // personel video formation
    public function personelvideoFormation(String $user , String $video);
    
    //all short cours by goals
    public function CourShort(String $user);

    //cours
    public function Cour_Conference();
    public function Cour_Podcast();
    public function Cour_Formation();

    
    //Qsm formation
    public function Cour_Fourmation_Qsm(String $id); 
    //create question answer for user
    public function user_answer(Request $request ,String $user , String $cour , String $questionId);

    
    //tree Cours first
    public function treeCoursFormation(String $user);

    // podcast by goals
    public function podcastgoals(String $user);


    public function Cour_Formation_detail(String $id);

    //Cour Favoris
    public function Cour_Favoris(String $id , String $cour);
    //all favoris
    public function AllFavoris(String $id);

    //Cours Comment
    public function CoursComment(String $id , String $cours , Request $request);

    //get Comment
    public function getComment(String $cours);

    //get goals
    public function getGoals();
    //user objectif
    public function UserObjectif(Request $request , $id , $goal);

    //get cours objectif
    public function CoursGoal(String $id);

    //get user manager
    public function getmanager();

    //create ticket
    public function store_ticket(Request $request , String $id);
    public function get_ticket(String $id);

}