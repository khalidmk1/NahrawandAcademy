<?php

namespace App\Services;
use App\Models\Cour;
use App\Models\Goal;
use App\Models\Role;
use App\Models\User;
use App\Models\Domain;
use App\Models\Ticket;
use App\Models\Program;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserRole;
use App\Models\ViewCour;
use App\Models\ShortCours;
use App\Models\UserClient;
use App\Models\QuizSeccess;
use Illuminate\Support\Str;
use App\Models\CoursComment;
use App\Models\CoursFavoris;
use App\Models\QuizQuestion;
use App\Models\UserObjectif;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\QuestionAnswers;
use App\Models\CoursPadcastVideo;
use App\Models\CoursFormationVideo;
use App\Models\VideoProgressPodcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\VideoProgressFormation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\RepositoryInterface\apiRepositoryInterface;

class ApiServicesRepository  implements apiRepositoryInterface
{

    //client password
    public function password_update(Request $request )
    {

        $validate = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password_change' => 1,
            'password' => Hash::make($validate['password']),
        ]);

        return response()->json(['message' => 'you have updated password']);

    }

    // get clinet by id
    public function getClientById(String $id)
    {
        $user = User::findOrFail($id);
    
        return response()->json($user);
    }

    public function update_client(Request $request , String $id){

        $user = User::findOrFail($id);


        $request->validate([
            'firstName' => [ 'string', 'max:255'],
            'lastName' => [ 'string', 'max:255'],
            'status'  => [ 'string', 'max:255'],
            'numchid' => ['integer'],
            'profission'  => [ 'string', 'max:255'],
            'email' => 'email|unique:users,email,' . $user->id,
            'avatar' => ['string']

        ]);


        if ($request->has('avatar')) {
            $avatarData = $request->avatar;
            $avatarData = str_replace('data:image/png;base64,', '', $avatarData);
            $avatarData = str_replace(' ', '+', $avatarData);
            $avatarImage = base64_decode($avatarData);
            $fileName = 'avatar_' . Str::uuid() . '.png'; 
            Storage::disk('public')->put('avatars/' . $fileName, $avatarImage);

            // Delete the old avatar if it exists
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            /* dd($fileName);
 */
            // Update user's avatar field with the new filename
            $user->avatar = $fileName;
        }

        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'datebirt' => $request->date_birte,
            'status_matrimonial' => $request->status,
            'Numchild' => $request->numchild,
            'profission' => $request->profission
        ]);

    
        return response()->json([$user]);
    }


    public function populaire_speaker()
    {
        $speaker = User::where('is_popular' , true)->get();
        $speaker->load('userspeaker');

        return response()->json($speaker);
    }

    public function coming_cours(){

        $comingCours = Cour::where('isComing' , 1)->get();
        
        foreach ($comingCours as $coming) {
            $coming->load('category');
           
            $coming->load([ 'CoursPodcast'  , 'CoursFormation']);
          
        }
        
        return response()->json($comingCours);

       

    }

    public function domain(){
        $domain = Domain::all();
    
        foreach ($domain as $d) {
            $d->category->load(['souscategories' => function ($query) {
                $query->has('goals');
            }]);
            
            $d->category->souscategories->each(function ($souscategory) {
                $souscategory->load('goals');
            });
        }
    
        return response()->json($domain);
    }
    

    public function program()
{
    $program = Program::with(['CourFormation.cours' => function ($query) {
            $query->where(['isComing'=> 0  , 'cours_type' => 'formation'] );
        }])
        ->get();
    return response()->json($program);
}


    //all cours

    public function allCours(){
    $cours = Cour::all();

    /* $courConference->load('category'); */

    $cours->load(['category' , 'CoursConference' ,  
    'CoursPodcast' , 'CoursFormation']);
    
    return response()->json($cours);
    }

    //create personel cours
    public function personelCours(String $user , String $cour)
    {
        $users =  User::findOrFail($user);
        $Cours =  Cour::findOrFail($cour);

        $ExistPersonelCours = ViewCour::where(['user_id' => $users->id , 'cours_id' => $Cours->id])->exists();
        if(!$ExistPersonelCours){
            $viewCours = ViewCour::create([
                'user_id' => $users->id,
                'cours_id' => $Cours->id
            ]);
            return response()->json($viewCours);
        }else{
            return response()->json('already exists');
        }
        

       
    }

//get personel cours 
public function getpersonelCours(String $user)
{
    $users = User::findOrFail($user);

    $courFormation = Cour::where(['cours_type' => 'formation'])->get();

    $courFormation->load('category', 'CoursFormation', 'CoursFormation.user', 
    'CoursFormation.user.userspeaker', 'CoursFormation.CoursFormationVideo');

    $viewCours = ViewCour::where(['user_id' => $users->id])->get();

    $courFormation->each(function ($formation) use ($viewCours) {
      
        $formation->viewExists = $viewCours->contains('cours_id', $formation->id);
    });

    return response()->json(['contentFormation' => $courFormation]);
}

//personel video podcast

public function personelvideoPodcast(String $user , String $video)
{
    $users =  User::findOrFail($user);
    $video =  CoursPadcastVideo::findOrFail($video);

    $ExistPersonelvideo = VideoProgressPodcast::where(['user_id' => $users->id , 'video_id' => $video->id])->exists();
    if(!$ExistPersonelvideo){
        $viewVideo = VideoProgressPodcast::create([
            'user_id' => $users->id,
            'video_id' => $video->id
        ]);
        return response()->json($viewVideo);
    }else{
        return response()->json('already exists');
    }


}

// personel video formation
public function personelvideoFormation(String $user , String $video)
{
    $users =  User::findOrFail($user);
    $video =  CoursFormationVideo::findOrFail($video);

    $ExistPersonelvideo = VideoProgressFormation::where(['user_id' => $users->id , 'video_id' => $video->id])->exists();
    if(!$ExistPersonelvideo){
        $viewVideo = VideoProgressFormation::create([
            'user_id' => $users->id,
            'video_id' => $video->id
        ]);
        return response()->json($viewVideo);
    }else{
        return response()->json('already exists');
    }
}

public function Cour_Conference(){
    $courConference = Cour::where('cours_type' , 'conference')->get();

    //cour conference
    $courConference->load('category');
    $courConference->load([
        'CoursConference', 
        'CoursConference.user', 
        'CoursConference.user.userspeaker', 
        'CoursConference.ConferenceVideo', 
        'CoursConference.ConferenceVideo.guestvideo.user.conferenceGuests']);

    return response()->json(['contentConference' => $courConference]);

}


    //all short cours
    public function CourShort()
    {
        $Cours = ShortCours::all();
        $Cours->load(['user' , 'user.userspeaker']);
        return response()->json($Cours);
    }

    public function Cour_Podcast(){
        $courPodcast = Cour::where(['cours_type' => 'podcast' , 'isComing' => 0])->get();

        //cour Podcast
        
        $courPodcast->load('category');
        $courPodcast->load(['CoursPodcast' , 
        'CoursPodcast.user' , 
        'CoursPodcast.user.userspeaker',
        'CoursPodcast.videopodcast',
        'CoursPodcast.videopodcast.guestvideo.user' , 
        'CoursPodcast.videopodcast.guestvideo.user.userspeaker'
    ]);

        return response()->json(['contentPodcast' => $courPodcast]);

    }

    public function Cour_Formation(){
        $courFormation = Cour::where(['cours_type' => 'formation' , 'isComing' => 0])->get();

         //cour formation
        $courFormation->load('category');

        $courFormation->load(['CoursFormation' , 
        'CoursFormation.user' , 'CoursFormation.user.userspeaker',
        'CoursFormation.CoursFormationVideo']);
       

        return response()->json(['contentFormation' => $courFormation]);

    }

    public function Cour_Fourmation_Qsm(String $id)
    {
        $Cour =  Cour::findOrFail($id);
        $QuizSeccess = QuizSeccess::where('cours_id', $Cour->id)->first();

        $Cour_Qsm = QuizSeccess::where('cours_id' , $Cour->id)->get();

        $Cour_Question = QuizQuestion::where('cours_id' , $Cour->id )->get();

        $Cour_Qsm->load(['Question' ,'Answer' , 'Question.Answers']);

        return response()->json(['Cour_Qsm' => $Cour_Qsm , 'Cour_Question' => $Cour_Question]);

    }

    //create question answer for user
    public function user_answer(Request $request, String $user, String $cour, String $questionId)
    {
        try {
            $cour = Cour::findOrFail($cour);
            $user = User::findOrFail($user);
            $question = Question::findOrFail($questionId);
    
            // Check if the question belongs to the specified course
            if ($question->cours_id != $cour->id) {
                return response()->json('The specified question does not belong to the course.', 400);
            }
    
            $questionAnswerExists = QuestionAnswers::where([
                'cours_id' => $cour->id,
                'user_id' => $user->id,
                'question_id' => $question->id
            ])->exists();
    
            if ($questionAnswerExists) {
                return response()->json('You have already answered this question.', 400);
            }
    
            $answerQuestion = QuestionAnswers::create([
                'cours_id' => $cour->id,
                'user_id' => $user->id,
                'question_id' => $question->id,
                'answer' => $request->answer
            ]);
    
            return response()->json($answerQuestion);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    

    // get tree Cours 


    public function treeCoursFormation()
    {
        $TreecourFormation = Cour::where(['cours_type' => 'formation' , 'isComing' => 0])->get()->take(20);
         // cour formation tree
         $TreecourFormation->load('category');

       
        $TreecourFormation->load(['CoursFormation' , 
        'CoursFormation.user' , 'CoursFormation.user.userspeaker',
        'CoursFormation.CoursFormationVideo']);

        return response()->json(['TreecourFormation' => $TreecourFormation]);
    }



    public function Cour_Formation_detail(String $id){
        $cours = Cour::findOrFail($id);

         //cour conference
        $cours->load('category');
        $cours->load(['CoursFormation' , 'CoursFormation.user' ,
        'CoursFormation.CoursFormationVideo' , 

    ]);

        return response()->json(['contentFormation' => $cours]);

    }

    // favoris Cours
    public function Cour_Favoris(String $id , String $cour){

        $Cour = Cour::findOrFail($cour);
        $user = User::findOrFail($id);

       
        $folow_false = CoursFavoris::where('user_id', $user->id)
            ->where('cours_id', $Cour->id)
            ->where('state', 0)
            ->first();
        
        $folow_true = CoursFavoris::where('user_id', $user->id)
            ->where('cours_id', $Cour->id)
            ->where('state', 1)
            ->first();

        if ($folow_false) {
            $message = 'folow true';
            $folow_false->update([
                'state' => 1,
            ]);
            return response()->json($message);
        } elseif ($folow_true) {
            $message = 'folow false';
            $folow_true->update([
                'state' => 0,
            ]);
            return response()->json($message);
        } else {
            $message = 'folow created';
            $newfolow = CoursFavoris::create([
                'user_id' => $user->id,
                'cours_id' => $Cour->id,
                'state' => 1,
            ]);
            return response()->json($message);
        }
    }

    //all favoris 

    public function AllFavoris(String $id)
    {

        $user = User::findOrFail($id);
        
        $favoris = CoursFavoris::where(['user_id' => $user->id , 'state' => 1])->get();
        $favoris->load('cours');
        //formation
        $favoris->load(['cours.CoursFormation' ,'cours.CoursFormation.user' ,
        'cours.CoursPodcast' , 'cours.CoursPodcast.user' , 'cours.CoursConference' ,
        'cours.CoursConference.user' ]);

        return response()->json($favoris);
    }

    //Cours Comment

    public function CoursComment(String $id , String $cours , Request $request){
        
        $user = User::findOrFail($id);
        $cour = Cour::findOrFail($cours);

        $CoursCommentExiste = CoursComment::where(['cours_id' => $cour->id , 'user_id' => $user->id])->exists();

        $deleteCoursComments = CoursComment::where(['cours_id' => $cour->id , 'user_id' => $user->id])->first();

        if($CoursCommentExiste){
            $deleteCoursComments->delete();
        }
       
        $comment = CoursComment::create([
            'cours_id' => $cour->id,
            'user_id' => $user->id,
            'Comment' => $request->comment
        ]);

        $comment->load('user');

        return response()->json($comment);

    }

    public function getComment(String $cours)
    {
        $cours = Cour::findOrFail($cours);

        $comments = CoursComment::where('cours_id' ,$cours->id)->get();

        $comments->load('user');

        return response()->json($comments);

    }

    public function getGoals(){
        $goals = Goal::all();
        $goals->load('souscategory');

        return response()->json($goals);
    }

    //user objectif
    public function UserObjectif(Request $request , $id , $goal){

        $user = User::findOrFail($id);
        $goal = Goal::findOrFail($goal);

        $usergoal = UserObjectif::create([
            'user_id' => $user->id,
            'objetif_id' => $goal->id
        ]);

        return response()->json($usergoal);

    }

    public function CoursGoal(String $id)
    {
                
    }

    //get manager
    public function getmanager()
    {

        $excludedRoleIds = [1, 2, 3 , 4];

        $managers = RolePermission::where('permission_id' , 4)->get();

        $managers->load('userrole.user');
        
        return response()->json($managers);
        

    }


    //ticket store
    public function store_ticket(Request $request , String $id)
    {

        $user = User::findOrFail($id);

        

        $request->validate([
            'ticketType' => ['required' , 'string' , 'max:100'],
            'manager' => ['required'],
            'detail' => ['required' , 'string' , 'max:500']
        ]);

        $ticket = Ticket::create([
            'user_id'=> $user->id,
            'manager_id' => $request->manager,
            'Type_Ticket' => $request->ticketType,
            'status' => false,
            'detail' => $request->detail
        ]);

        return response()->json($ticket);

    }

    public function get_ticket(String $id){

        $user = User::findOrFail($id);

        $tickets = Ticket::where('user_id' , $user->id)->get();
        
        return response()->json($tickets);

        
    }

  

    


}