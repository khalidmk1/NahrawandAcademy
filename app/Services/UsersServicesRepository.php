<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\FAQ;
use App\Models\Cour;
use App\Models\Goal;
use App\Models\Role;
use App\Models\User;
use Aws\S3\S3Client;
use App\Models\Event;
use App\Models\Answer;
use App\Models\Domain;
use App\Models\Ticket;
use App\Mail\sendemail;
use App\Models\Profile;
use App\Models\Program;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserRole;
use App\Models\ViewCour;
use App\Models\ShortGoal;
use App\Models\UserEvent;
use App\Mail\SendInfoUser;
use App\Models\CoursGoals;
use App\Models\Permission;
use App\Models\ShortCours;
use App\Models\TicketFile;
use App\Models\QuizSeccess;
use Illuminate\Support\Str;
use App\Models\CoursPodcast;
use App\Models\QuizQuestion;
use App\Models\SousCategory;
use App\Models\UserObjectif;
use App\Models\UserSpeakers;
use Illuminate\Http\Request;
use App\Models\CommentTicket;
use App\Models\FineshedCours;
use App\Models\CoursFormation;
use App\Models\RolePermission;
use App\Models\CoursConference;
use Illuminate\Validation\Rules;
use App\Models\CoursPadcastGuest;
use App\Models\CoursPadcastVideo;
use App\Models\QuizSeccesseVideo;
use Illuminate\Http\UploadedFile;
use App\Models\CoursFormationVideo;
use App\Models\CoursConferenceGuest;
use App\Models\CoursConferenceVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\VideoProgressFormation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use App\RepositoryInterface\UsersRepositoryInterface;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;


class UsersServicesRepository  implements UsersRepositoryInterface
{

   


    //report of dashboard

    public function reportindex()
    {

        $category = Category::all();
        return view('Component.dashboard.reporting.report')->with('category' , $category);
    }

    public function ReportCount()
    {
        $RoleUser = UserRole::where('role_id' , 4)->get();

        $AuthUserCount = User::whereIn('id', $RoleUser->pluck('id'))->where('is_login', 1)->count() ;
        
        $NotAuthUserCount = User::whereIn('id', $RoleUser->pluck('id'))->where('is_login', 0)->count() ;


        return response()->json(['AuthUserCount' => $AuthUserCount , 
        'NotAuthUserCount' => $NotAuthUserCount]);
    }


    public function FilterCount(Request $request)
    {
        if($request->has('CategoryCours')){
            $CountCours = Cour::where('category_id' , $request->CategoryCours)->count();
            return response()->json($CountCours);
        }

        if($request->has('CategorySpeaker')){
            $CountSpeaker = Cour::where('category_id' , $request->CategorySpeaker)->get();
            return response()->json($CountSpeaker->count());
            
        }

        
    }

    // progress of user in the cours
    public function view_video(String $user , String $cour) 
    {
        $Cour = Cour::findOrFail($cour);
        $user = User::findOrFail($cour);

        $CourFormation = CoursFormation::where('cours_id' , $Cour)->get();

        $CourVideo = VideoProgressFormation::where(['user_id' => $user , ]);


        $Cour = Cour::findOrFail($cour);
        $user = User::findOrFail($user);
 
        $CourFormation = CoursFormation::where('cours_id' , $Cour->id)->get();

        $CourVideoIds = $CourFormation->pluck('id')->toArray();
        $CourVideo = CoursFormationVideo::whereIn('CourFormation_id' , $CourVideoIds)->get();
        $videoCount = $CourVideo->count();

        $Videoprogress = VideoProgressFormation::whereIn('video_id' , $CourVideo->pluck('id'))
        ->where('user_id' , $user->id)
        ->count();

        if($videoCount == $Videoprogress)
        {
            return response()->json(true);
        }

        return response()->json(false);
    }


    // serch functionality
    public function search_filtter(Request $request)
    {
        $output = "";

        if($request->has('category')){
            $category = $request->input('category');

            $categorys = Category::where('category_name', 'like', '%'.$category.'%')->get();

            $output .= view('filtering.search.category')->with('categorys' , $categorys)->render();

            
        }

        if($request->has('goal')){
            $goal = $request->input('goal');

            $goals = Goal::where('goals', 'like', '%'.$goal.'%')->get();

            $output .=view('filtering.search.goals')->with('goals' , $goals)->render();
        }


        if($request->has('souscategory')){
            $couscategory = $request->input('souscategory');

            $soucategorys =  SousCategory::where('souscategory_name', 'like', '%'.$couscategory.'%')->get();

            $output .=view('filtering.search.sousCategory')->with('soucategorys' , $soucategorys)->render();
        }




        return response()->json($output);
    }


    public function search_profile(Request $request )
    {
    
        $output = "";
    
        if($request->has('admin')){
            $admins = $request->input('admin');
            $admins = User::where('firstName', 'like', '%'.$admins.'%')->get();
    
            foreach ($admins as $key => $admin) {
                $rolesUser = UserRole::where(['user_id' => $admin->id , 'role_id' => 2])->get();
                $output .= view('Component.Profile.search.admin')->with('rolesUser' , $rolesUser)->render();
            }
    
        }
    
        if($request->has('manager')){
            
            $managers = $request->input('manager');
            
            $managers = User::where('firstName', 'like', '%'.$managers.'%')->get();
            
            foreach ($managers as $key => $manager) {
                
                $rolesUser = UserRole::whereNotIn('role_id', [1, 2, 3, 4])
                         ->where('user_id', $manager->id)
                         ->get();
                $output .= view('Component.Profile.search.manager')->with('rolesUser' , $rolesUser)->render();
            }
        
        }
    
        if($request->has('speaker')){
            $speakers = $request->input('speaker');
            
            $speakers = User::where('firstName', 'like', '%'.$speakers.'%')->get();
            
            foreach ($speakers as $key => $speaker) {
                
                $rolesUser = UserRole::where(['user_id' => $speaker->id , 'role_id' => 3])->get();
                $output .= view('Component.Profile.search.speaker')->with('rolesUser' , $rolesUser)->render();
            }
        }
    
    
        return response()->json($output);
    }


    public function search_role(Request $request)
    {
        $query = $request->input('role');

        $output = "";

        $permissions = Permission::all();

        $roleId = [3 , 4];
        $roles = Role::whereNotIn('id' , $roleId)->get();

        
        $RolePermissioncheck = RolePermission::whereIn('permission_id', $permissions->pluck('id'))
        ->where('confirmed', 1)
        ->whereIn('role_id', $roles->pluck('id'))
        ->get()
        ->groupBy('role_id');

        $filteredRoles = Role::where('role_name', 'like', '%'.$query.'%')
        ->whereNotIn('id', $roleId)
        ->get();


        $output .= view('Component.Profile.search.role')->with(['filteredRoles' =>$filteredRoles , 
        'permissions'=> $permissions ,'roles' => $roles ,
        'RolePermissioncheck' => $RolePermissioncheck])->render();


    
        return response()->json(['output' => $output]);
    }


    //serch cours
    public function search_cours(Request $request)
    {
        $output = "";
        $Cours = Cour::query();

        // Search by title
        if ($request->has('title')) {
            $title_cours = $request->input('title');
            $Cours->where('title', 'like', '%' . $title_cours . '%');
        }

        // Search by host_id in CoursFormation
        if ($request->has('user')) {
            $host_id = $request->input('user');
            $Cours->whereHas('CoursFormation', function ($query) use ($host_id) {
                $query->where('host_id', $host_id);
            });
        }

        // Search by host_id in CoursPodcast
        if ($request->has('user')) {
            $host_id = $request->input('user');
            $Cours->orWhereHas('CoursPodcast', function ($query) use ($host_id) {
                $query->where('host_id', $host_id);
            });
        }

        if ($request->has('category')) {
            $category_cours = $request->input('category');
            $Cours->orWhereHas('category_id', 'like', '%' . $category_cours . '%');
        }


        $Cours = $Cours->get();

        foreach ($Cours as $key => $cour) {
            $output .= view('Cours.cherche.CoursCard')->with('cour', $cour)->render();
        }

        return response()->json(['output' => $output]);
    }

    //search short
    public function search_short(Request $request)
    {
        $output = "";
        $shorts = ShortCours::query();

        // Search by title
        if ($request->has('title')) {
            $title_cours = $request->input('title');
            $shorts->where('title', 'like', '%' . $title_cours . '%');
        }

        // Search by host_id in CoursFormation
        if ($request->has('user')) {
            $host_id = $request->input('user');
            $shorts->where('host_id', 'like', '%' . $host_id . '%');
        }

        if ($request->has('goals')) {
            $goal = $request->input('goals');
            $shorts->whereHas('shortCours', function ($query) use ($goal) {
                $query->where('goal_id', $goal);
            });
        }


        $shorts = $shorts->get();
        $output .= view('Cours.cherche.short.ShortCard')->with('shorts', $shorts)->render();

        return response()->json(['output' => $output]);
    }

    //search history
    public function search_history(Request $request)
    {
        $output = "";
        $shorts = ShortCours::query();
        $Cours = Cour::query();

        // Search by title
        if ($request->has('title')) {
            $title_cours = $request->input('title');
            $shorts->onlyTrashed('title', 'like', '%' . $title_cours . '%');
            
        }
    /*  // Search by title
        if ($request->has('title')) {
            $title_cours = $request->input('title');
            $Cours->where('title', 'like', '%' . $title_cours . '%'); 
        } */
        $shorts = $shorts->get();
        $output .= view('Hisotry.chereche.CardCours')->with(['shorts'=> $shorts ])->render();

        return response()->json($output);
    }




    //crud profile

    public function edit_profile(String $id){
        return User::findOrFail(Crypt::decrypt($id));
    }


    public function update_profile(Request $request, $id)
    {
        $profile = User::findOrFail(Crypt::decrypt($id));
        $userSpeaker = UserSpeakers::where('user_id', $profile->id)->first();
        $Cour = Cour::all();
        $coursConference = CoursConference::whereIn('cours_id' , $Cour->pluck('id'))
        ->where('host_id' , $profile->id)
        ->exists();
        $coursPodcast = CoursPodcast::whereIn('cours_id' , $Cour->pluck('id')) 
        ->where('host_id' , $profile->id)
        ->exists();
        $courFormation = CoursFormation::whereIn('cours_id' , $Cour->pluck('id'))
        ->where('host_id' , $profile->id)
        ->exists();
    
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'avatar' => ['file', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'profile_image' => ['file', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'email' => 'required|email|unique:users,email,' . $profile->id,
        ]);

        $isPopulaire = $request->isPopulaire == 'on';
    
        if ($request->hasFile('avatar')) {
            $imagePath = 'avatars/' . $profile->avatar;
            Storage::disk('public')->delete($imagePath);
    
            $file = $request->file('avatar');
            $directory = 'avatars/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');

            $profile->update([
                'avatar' => $fileNameImage
            ]);

        }
    
        if ($request->hasFile('profile_image')) {
            $imagePath = 'profile/' . $profile->profile_image;
            Storage::disk('public')->delete($imagePath);
    
            $file = $request->file('profile_image');
            $directory = 'profile/';
            $fileNameImageProfile = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImageProfile, 'public');
    
            $profile->update([
                'profile_image' => $fileNameImageProfile
            ]);
        }
    
        $profile->firstName = $request->firstName;
        $profile->lastName = $request->lastName;
        $profile->is_popular = $isPopulaire;
        $profile->email = $request->email;
    
        if ($profile->userRole->role_id == 3) {
            $rules = [
                'biographie' => ['required', 'string', 'max:300'],
                'facebook' => ['nullable', 'url', 'regex:/facebook.com/'],
                'linkedin' => ['nullable', 'url', 'regex:/linkedin.com/'],
                'instagram' => ['nullable', 'url', 'regex:/instagram.com/'],
            ];
    
            $request->validate($rules);

            $userSpeaker->biographie = $request->biographie;
            if ($request->has('type_speaker')) {
                if ( $coursConference || $coursPodcast || $courFormation) {
                    return redirect()->back()->withErrors(['type' => 'Cannot change type because the user is already associated with content.']);
                }
            } 

            $userSpeaker->type_speaker = $request->type_speaker;
            $userSpeaker->faceboock = $request->facebook;
            $userSpeaker->linkdin = $request->linkedin;
            $userSpeaker->instagram = $request->instagram;
            $userSpeaker->save();
            
            return redirect()->back()->with('status' , 'Vous avez modifier Avec sseccess');

        }
    
        $profile->save();

        return redirect()->back()->with('status' , 'Vous avez modifier Avec sseccess');
    }


    public function delet_profile(Request $request ,String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $user->userRole()->delete();
    
            $user->delete();
           
        }

    }




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

        

    }






    //crud permission

    public function store_permission(Request $request )
    {

        /* $domain = Domain::create([
            'domain' => $request->domain,
        ]); */

        $permission =  Permission::create([
            'permission_name' => $request->permission_name,
        ]);
        

    }


    //crud role

    public function create_role(){
        $permissions = Permission::all();

        $permission = Permission::findOrFail(7);
        $user_role = auth()->user()->userRole->role_id;

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'permission_id' => $permission->id,
            'confirmed' => '1',
        ])->exists();

        $roleId = [3 , 4];
        $roles = Role::whereNotIn('id' , $roleId)->get();
        
        $RolePermissioncheck = RolePermission::whereIn('permission_id', $permissions->pluck('id'))
        ->where('confirmed', 1)
        ->whereIn('role_id', $roles->pluck('id'))
        ->get()
        ->groupBy('role_id');

        return ['rolePermissionExists' => $rolePermissionExists, 'permissions'=> $permissions ,'roles' => $roles ,'RolePermissioncheck' => $RolePermissioncheck]; 
    }

    public function store_role(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create([
            'role_name' => $request->title,
            'description' => $request->description
        ]);


    }



    //crud role_permission

    public function store_role_permission(String $role , String $permission)
    {
        $RolePermissionNotExiste = RolePermission::where(['role_id' => $role , 'permission_id' => $permission])->exists();
        $HasNotPermission = RolePermission::where(['role_id' => $role , 'permission_id' => $permission , 'confirmed' => 0])->exists();
        $changepermission = RolePermission::where(['role_id' => $role , 'permission_id' => $permission])->first();
        

        if(!$RolePermissionNotExiste){
            $RolePermission = RolePermission::create([
                'role_id' => $role,
                'permission_id' => $permission,
                'confirmed' => true
            ]);
        }else if($HasNotPermission){
            $changepermission->update([
                'confirmed' => true
            ]);
        } else{
            $changepermission->update([
                'confirmed' => false
            ]);
        }

        return ['RolePermissionExiste'=>$RolePermissionNotExiste ];

    }


    //crud manager

    public function view_manager()
    {

        $excludedRoleIds = [1, 2, 3 , 4];

        $managers = UserRole::whereNotIn('role_id', $excludedRoleIds)->paginate(10);
        
        return $managers;

    }

    public function create_manger(){
        $roles = Role::whereNotIn('id', [1, 2 , 3 , 4])->get();

        return ['roles'=>$roles] ;
    }

    public function store_manager(Request $request){

        $request->validate([
            'avatar' => ['required', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ($request->password == null) ? [] : ['confirmed', Rules\Password::defaults()],
        ]);
    
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $directory = '/avatars';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
           
            $file->storeAs($directory, $fileName, 'public');
            
        }
    
        $password = $request->password ?? Str::random(10);
    
        $user = User::create([
            'avatar' => $fileName ?? null,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);
    
        $user_role = UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id
        ]);
    
        Mail::to($user->email)->send(new SendInfoUser($user , $password));
        return redirect()->back()->with('status' , 'Un utilisateur Manager a été créé avec succès. ');
    }
    


    //crud speakers

    public function view_speaker()
    {
        $role = Role::where('role_name' , 'Speaker')->first();

        $speakers = UserRole::where('role_id' , $role->id)->paginate(9);

        return $speakers;
    }


    public function create_speakers()
    {
        $permission = Permission::findOrFail(6);
        $user_role = auth()->user()->userRole->role_id;

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'permission_id' => $permission->id,
            'confirmed' => '1',
        ])->exists();


        return ['rolePermissionExists' => $rolePermissionExists];
    }


    public function store_speaker(Request $request){
        $role_admin = Role::where('role_name', 'Speaker')->first();
    
        $request->validate([
            'avatar' => ['required', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'profile_image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'type_speaker' => ['required', 'string', 'max:255'],
            'biographie' => ['required', 'string', 'max:300'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'facebook' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
        ]);
        
        $isPopulaire = $request->isPopulaire == 'on';
        $password  = Str::random(10);
        $request->password_confirmation = $password;
    
        $invalidUrls = [];
    
        // Check URLs only if they are not empty
        if (!empty($request->facebook) && !str_contains($request->facebook, 'facebook.com')) {
            $invalidUrls[] = 'Facebook';
        }
        if (!empty($request->linkedin) && !str_contains($request->linkedin, 'linkedin.com')) {
            $invalidUrls[] = 'LinkedIn';
        }
        if (!empty($request->instagram) && !str_contains($request->instagram, 'instagram.com')) {
            $invalidUrls[] = 'Instagram';
        }
        
       
    
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $directory = 'avatars/';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName, 'public');
        }
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $directory = 'profile/';
            $fileNameProfile = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameProfile, 'public');
        }
    
        $user = User::create([
            'avatar' => $fileName,
            'profile_image' => $fileNameProfile,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'password_change' => 1,
            'is_popular' =>$isPopulaire,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);
    
        $user_role = UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role_admin->id
        ]);
    
        $speaker = UserSpeakers::create([
            'user_id' => $user->id,
            'type_speaker' => $request->type_speaker,
            'biographie' => $request->biographie,
            'faceboock' => $request->facebook,
            'linkdin' => $request->linkedin,
            'instagram' => $request->instagram
        ]); 

        if (!empty($invalidUrls)) {
            return redirect()->back()->with(['faild' => 'Invalid URLs for: ' . implode(', ', $invalidUrls)]);
        }else{
            return redirect()->back()->with('status', 'Un utilisateur intervenant a été créé avec succès.');
        }
    
        
    }
    


    public function delete_speaker(Request $request ,String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $user->userRole()->delete();

            $user->userspeaker->delete();

            $imagePath = 'avatars/'.$user->avatar;
            Storage::disk('public')->delete($imagePath);
    
            $user->delete();
           
        }
    }


    //crud admin

    

    public function view_admin()
    {
        $role = Role::where('role_name' , 'Admin')->first();

        $admins = UserRole::where('role_id' , $role->id)->paginate(10);

        return $admins;
    }

    public function store_admin(Request $request){

        $role_admin = Role::where('role_name', 'Admin')->first();
    
        $request->validate([
            'avatar' => ['required', 'file', 'mimes:png,jpg' , 'max:2000'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ($request->password == null) ? [] : ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $directory = '/avatars';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            // Store the file in the public storage directory
            $file->storeAs($directory, $fileName, 'public');
            
        }
    
        $password = $request->password ?? Str::random(10);
    
        $user = User::create([
            'avatar' => $fileName,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);
    
        $user_role = UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role_admin->id
        ]);
    
        Mail::to($user->email)->send(new SendInfoUser($user , $password));
        
        return redirect()->back()->with('status', 'Un utilisateur administratif a été créé avec succès.'); 
    }



    //crud client

    public function view_client()
    {
        $role = Role::where('role_name' , 'Client')->first();

        $Clients = UserRole::where('role_id' , $role->id)->get();

        return view('Component.Profile.view.client')->with('Clients' , $Clients);
    }

    public function detail_client(String $id)
    {
        $client = User::findOrFail(Crypt::decrypt($id));
        
        // Retrieve all courFormation
        $courFormation = Cour::where(['cours_type' => 'formation', 'isComing' => 0])->get();
        $FineshedCours = FineshedCours::where('user_id' , $client->id)->get();

        // Retrieve viewCours for the user
        $viewCours = ViewCour::whereNotIn('cours_id' , $FineshedCours->pluck('cours_id'))
        ->where('user_id', $client->id)->get(); 
        

        // Retrieve the UserObjectifs related to the client
        $doamin1 = UserObjectif::where('user_id', $client->id)
            ->whereHas('goals.souscategory.category.domain', function ($query) {
                // Filter the goals based on the domain_id
                $query->where('domain_id', 1);
            })
            ->get();
        $doamin2 = UserObjectif::where('user_id', $client->id)
            ->whereHas('goals.souscategory.category.domain', function ($query) {
                // Filter the goals based on the domain_id
                $query->where('domain_id', 2);
            })
            ->get();
        $doamin3 = UserObjectif::where('user_id', $client->id)
            ->whereHas('goals.souscategory.category.domain', function ($query) {
                // Filter the goals based on the domain_id
                $query->where('domain_id', 3);
            })
            ->get();
        $doamin4 = UserObjectif::where('user_id', $client->id)
            ->whereHas('goals.souscategory.category.domain', function ($query) {
                // Filter the goals based on the domain_id
                $query->where('domain_id', 4);
            })
            ->get();

    
        return view('Component.Profile.detail.client')->with([
            'client' => $client, 'FineshedCours' => $FineshedCours,
            'viewCours' => $viewCours,'doamin1' => $doamin1 , 
            'doamin2' =>$doamin2 , 'doamin3' => $doamin3 , 'doamin4' => $doamin4
        ]);
    }
    

    
    


    //crud category

    public function create_category()
    {
        $categories = Category::paginate(10);

        $domains = Domain::all();

    
        return ['categories' => $categories , 'domains' => $domains ];
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'domains' =>  ['required', 'string', 'max:255'],
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        $categorie = Category::create([
            'domain_id' => $request->domains,
            'category_name' => $request->category_name,
        ]);

    }

    public function update_category(Request $request , String $id)
    {
        $category = Category::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        /* dd($profile); */
        
        $category->category_name = $request->category_name;
       
        
        $category->save();
    }

    public function delete_category(Request $request ,String $id)
    {
        $category =  Category::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required'],
        ]);

        $CheckExiseciteInCours = Cour::where('category_id' , $category->id)->exists();
    
        if(Hash::check( $request->password, Auth::user()->password) && !$CheckExiseciteInCours){
            foreach ($category->souscategories as $souscategory) {
                $souscategory->delete();
                $souscategory->goals()->delete();
            }
    
            $category->delete();
            return redirect()->back()->with('status' , 'Vous Avez Suprimer le Categorie');
        }else{
    
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect ou La categorie déja exists dans un contenu');
        }
    
    }


    //restore category
    public function restore_history_category(String $id)
    {
        $Category = Category::withTrashed()->findOrFail(Crypt::decrypt($id));
       
        $Category->restore();

        return redirect()->back()->with('status' , 'Vous Avez Restore votre Category');

    }


 





    //crud souscategorie

    public function create_souscategory()
    {
        $souscategories = SousCategory::paginate(10);
        $categories = Category::all();

        return ['souscategories'=>$souscategories , 'categories' => $categories];
    }

    public function store_souscategory(Request $request)
    {
        $request->validate([
            'souscategory_name' => ['required', 'string', 'max:255'],
        ]);

        $categorie = SousCategory::create([
            'category_id' => $request->category,
            'souscategory_name' => $request->souscategory_name,
        ]);
    }

    public function update_souscategory(Request $request , String $id)
    {
        $souscategorie = SousCategory::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'souscategory_name' => ['required', 'string', 'max:255'],
        ]);
        

        $souscategorie->category_id = $request->category;
        $souscategorie->souscategory_name = $request->souscategory_name;
       
        $souscategorie->save();
    }

    
    // Define the delete_souscategory method here
    public function delete_souscategory(Request $request, String $id)
    {
        $souscategory = SousCategory::findOrFail(Crypt::decrypt($id));
        $Category = Category::where('id', $souscategory->category_id)->get();
      
        $CheckExiseciteInCours = Cour::whereIn('category_id', $Category->pluck('id'))
            ->whereNull('deleted_at')
            ->exists();

        $request->validate([
            'password' => ['required']
        ]);

        if (Hash::check($request->password, Auth::user()->password) && !$CheckExiseciteInCours) {
            $souscategory->delete();
            $souscategory->goals()->delete();

            return redirect()->back()->with('status', 'Vous avez supprimé le SousCategorie');
        }

        return redirect()->back()->with('faild', 'Votre mot de passe est incorrect ou il est déjà associé à un contenu');
    }

    //restore SubCategory
    public function restore_history_subcategory(String $id)
    {
        $SubCategory = SousCategory::withTrashed()->findOrFail(Crypt::decrypt($id));
        
        $SubCategory->restore();
 
        return redirect()->back()->with('status' , 'Vous Restore votre SubCategory');
 
    }





    //crud Program

    public function create_program(){
        $categories = Category::all();

        $programs = Program::all();

      
        return [ 'categories' => $categories , 'programs' => $programs];
    }

    public function store_program(Request $request)
    {

     
        $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'Description'=> ['required', 'string', 'max:600'],
            'tags'=> ['required', 'array'],
            'categories'=> ['required', 'array']
        ]);

        foreach ($request->tags as $key => $tag) {
            $tags[] = $tag; 
        }

        foreach ($request->categories as $key => $category) {
            $categories[] = $category ;
        }

        $program = Program::create([
            'title' => $request->title,
            'Description' => $request->Description,
            'tags' => $tags,
            'categories' => $categories
        ]);
       

    }

    public function update_program(Request $request , String $id)
    {
        $program = Program::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'Description'=> ['required', 'string', 'max:600'],
            'tags'=> ['required', 'array'],
            'categories'=> ['required', 'array']
        ]);

        foreach ($request->tags as $key => $tag) {
            $tags[] = $tag; 
        }

        foreach ($request->categories as $key => $category) {
            $categories[] = $category ;
        }

        $program->title = $request->title;
        $program->Description = $request->Description;
        $program->tags = $tags;
        $program->categories = $categories;

        $program->save();



    }

    //delete program
    public function delete_program(Request $request , String $id)
    {

        $program = Program::findOrFail(Crypt::decrypt($id));

        $CourProgram = CoursFormation::where('program_id' , $program->id)
        ->whereNull('deleted_at')
        ->exists();
      
        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ) && !$CourProgram)
        {
            $program->delete();
            return redirect()->back()->with('status' , 'Vous Avez Suprimer le Program');
        }
           
        return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect Ou Il est déja associer avec un contenu');

    } 


    //restore Program
    public function restore_history_program(String $id)
    {
        $program = Program::withTrashed()->findOrFail(Crypt::decrypt($id));

        $program->restore();

        return redirect()->back()->with('status' , 'Vous Restore votre Cours');

    }

    

    //crud goals

    public function create_goals()
    {
        $goals = Goal::paginate(10);

        $souscategory = SousCategory::all();

        return ['goals' =>  $goals , 'souscategory' => $souscategory];
    }


    public function store_goals(Request $request)
    {
        $request->validate([
            'goals' =>  ['required', 'string', 'max:255'],
        ]);

        foreach ($request->souscatgory as $key => $souscatgory) {
            $goal = Goal::create([
                'souscategory_id' => $souscatgory,
                'goals' => $request->goals,
    
            ]);
    
        }
       
    }


    public function update_goals(Request $request , String $id)
    {
        $goal = Goal::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'goals' => ['required', 'string', 'max:255'],
        ]);


        $goal->souscategory_id = $request->souscatgory;
        $goal->goals = $request->goals;

        $goal->save();

    }

    public function delete_goals(Request $request , String $id)
    {
        $goal = Goal::findOrFail(Crypt::decrypt($id));

        $Cours= Cour::all();

        $CourGoalsExists = CoursGoals::whereIn('cours_id' , $Cours->pluck('id'))
        ->where('goal_id' , $goal->id)
        ->exists();

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ) && !$CourGoalsExists)
        {

            $goal->delete();

            return redirect()->back()->with('status' , 'Vous Avez Suprimer un Objectif');
           
        }

        return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect Ou il est déja Associer Avec contenu');
       
    } 

    //restore Objectives
    public function restore_history_Objectives(String $id)
    {
        $goal = Goal::withTrashed()->findOrFail(Crypt::decrypt($id));
       
        $goal->restore();

        return redirect()->back()->with('status' , 'Vous Restore votre Objective');

    }


//crud cours 

public function index_cours()
{
    $cours = Cour::paginate(10);

    $cours->load(['CoursConference' , 'CoursPodcast' , 'CoursFormation']);

    $RoleUser = UserRole::where('role_id' , 3)->get();

    $category = Category::all();
    
    return view('Cours.show.Cours')->with(['cours' => $cours , 'RoleUser' => $RoleUser ,
    'category' => $category
]);
}
    


    public function show_cour(String $id)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));

        $category = Category::whereHas('souscategories.goals')->get();

        $subCategorys = SousCategory::all();

        $CoursGols = CoursGoals::where('cours_id' , $Cour->id)->get();


        if($Cour->cours_type == 'conference'){
            
            //cours Conference
            $coursCoference = CoursConference::where('cours_id' , $Cour->id)->first();
            
            $ConfrenceGuest = CoursConferenceGuest::whereIn('coursconferencevideo_id' , $coursCoference->ConferenceVideo->pluck('id'))
            ->get();

        
            $HostConfrence = UserSpeakers::where('type_speaker' , 'Modérateur')->get();
            $GuestConfrence = UserSpeakers::where('type_speaker' , 'Conférencier')->get();
            
            return view('Cours.detail.conference')->with(['Cour' => $Cour , 
            'coursCoference' =>$coursCoference , 'ConfrenceGuest' => $ConfrenceGuest , 
            'category' => $category , 'CoursGols' =>$CoursGols , 'subCategorys' => $subCategorys ,
            'HostConfrence' => $HostConfrence , 'GuestConfrence' => $GuestConfrence]);

        }elseif ($Cour->cours_type == 'podcast') {
            
            //Cours Podcast
            
            $coursPodcast = CoursPodcast::where('cours_id' , $Cour->id)
            ->first();

            $podcastVideoId = $coursPodcast->videopodcast->pluck('id');

            
            $PodcastGuest = CoursPadcastGuest::whereIn('podcastvideo_id' , $podcastVideoId)
            ->get();

            $HostPodcast = UserSpeakers::where('type_speaker' , 'Animateur')->get();
            $GuestPodcastAll = UserSpeakers::where('type_speaker' , 'Invité')->get();

           

            return view('Cours.detail.podcast')->with(['Cour' => $Cour , 
            'coursPodcast' =>$coursPodcast , 'PodcastGuest' => $PodcastGuest , 
            'category' => $category , 'CoursGols' => $CoursGols , 'subCategorys' => $subCategorys ,
            'HostPodcast' => $HostPodcast , 'GuestPodcastAll' => $GuestPodcastAll]);
        
        }elseif ($Cour->cours_type == 'formation') {

             //Cours Formation
             $coursFormation = CoursFormation::where('cours_id' , $Cour->id)->first();
            
             $programs = Program::all();
             $HostFromateur = UserSpeakers::where('type_speaker' , 'Formateur')->get();
             //Qsm
             $Qsm = QuizSeccess::where('cours_id' , $Cour->id)->get();
             //Questionnaire
             $Questions = QuizQuestion::where('cours_id' , $Cour->id)->get();

          

            return view('Cours.detail.formation')->with(['Cour' => $Cour , 
            'coursFormation' =>$coursFormation ,'Qsm' => $Qsm , 'programs' => $programs,
            'category' => $category , 'CoursGols' => $CoursGols, 'subCategorys' => $subCategorys ,
            'HostFromateur' => $HostFromateur , 'Questions' => $Questions
        ]);

        } 

    }


    public function show_short()
    {
        $shorts = ShortCours::paginate(10);
        $RoleUser = UserRole::where('role_id' , 3)->get();
        $category = Category::all();

        $shortGoals = [];

        return view('Cours.show.short')->with(['shorts' => $shorts  ,
        'RoleUser' => $RoleUser , 'category' => $category]);
    }


    //show detail short cours
    public function detail_short(String $id)
    {
        $short = ShortCours::findOrFail(Crypt::decrypt($id));
        $HostFromateur = UserSpeakers::where('type_speaker' , 'Formateur')->get();
        $category = Category::whereHas('souscategories.goals')->get();
        $goals = Goal::all();
        $CoursGols = ShortGoal::where('cour_id' , $short->id)->get();

        return view('Cours.detail.short')->with(['short' => $short , 
        'HostFromateur' => $HostFromateur , 'category' => $category ,
        'goals' => $goals , 'CoursGols' => $CoursGols
    ]);
    }

    public function create_cours()
    {
        $category = Category::whereHas('souscategories.goals')->get();
        $subCategory = SousCategory::all();

        $HostConfrence = UserSpeakers::where('type_speaker' , 'Modérateur')->get();

        $HostPodcast = UserSpeakers::where('type_speaker' , 'Animateur')->get();

        $HostFormation = UserSpeakers::where('type_speaker' , 'Formateur')->get();

        $Programs = Program::all();


        return ['category' =>$category , 'HostConfrence' => $HostConfrence , 'HostPodcast' => $HostPodcast 
        , 'HostFormateur' => $HostFormation , 'Programs' => $Programs , 'subCategory' => $subCategory] ;
    }

    // create short
    public function create_short()
    {
        $HostFromateur = UserSpeakers::where('type_speaker' , 'Formateur')->get();

        $category = Category::whereHas('souscategories.goals')->get();

        return view('Cours.create.short.short')->with(['HostFromateur' => $HostFromateur ,
        'category' => $category]);
    }

    //update short cours
    public function update_short(Request $request ,String $id)
    {

        $Cour = ShortCours::findOrFail(Crypt::decrypt($id));
        $goalCours = ShortGoal::where('cour_id' , $Cour->id)->get();

        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'tags' => ['required' , 'array'],
            'host' => ['required' , 'string'],
            'goal' => ['required' , 'array'],
            'image' => ['file' ,  'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'coursImageflex' => ['file' ,  'mimes:jpeg,png,jpg,gif' , 'max:2000'],
        ]);

        $url = $request->video;

       

        if ($request->hasFile('image')) {
            $imagePath = 'upload/cour/image/'.$Cour->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('image');
            $directory = 'upload/cour/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $Cour->image = $fileNameImage;
        }
        if ($request->hasFile('coursImageflex')) {
            $imagePath = 'upload/cour/image/flex/'.$Cour->image_flex;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('coursImageflex');
            $directory = 'upload/cour/image/flex/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $Cour->image_flex = $fileNameImage;
        }

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $Cour->video = 'https://www.youtube.com/embed/'.$videoId;
        }



        $Cour->title = $request->title;


        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;

       
        $goalCours->each->forceDelete();
        foreach ($request->goal as $key => $goal) {
            $goalCours = new ShortGoal();
            $goalCours->cour_id = $Cour->id; 
            $goalCours->goal_id = $goal;
           
            $goalCours->save();
        }
        
        $Cour->host_id = $request->host;

        $Cour->save();
    
        return redirect()->back()->with('status' , 'Vous avez mis à jour le short avec succès.');

    }

    //delete short cours
    public function delete_short(Request $request , String $id){
        $courshort = ShortCours::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            $courshort->delete();
            return redirect()->route('dashboard.show.short')->with('status' , 'you have deleted a cours');
        }
        return redirect()->back()->with('faild' , 'Voter Mots de Passe et Incorrec');
    }

    public function getGoalsBySousCategorie(String $id)
    {
        $Category = Category::findOrFail($id);
        $SousCategory = SousCategory::where('category_id' , $Category->id)->get();
        $goals = Goal::whereIn('souscategory_id', $SousCategory->pluck('id'))->get();
        return response()->json(['goals' => $goals]);
    }



    //store cours
public function store_cours(Request $request)
{

    $commonRules = [
        'title' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:300'],
        'cotegoryId' => ['required', 'string', 'max:255'],
        'tags' => ['required', 'array'],
        'gaols_id' => ['required', 'array'],
        'coursType' => ['required', 'string', 'max:255'],
        'subcategoryId' => ['required'],
    ];

    $request->validate($commonRules);

    $additionalRules = [];
    $iscoming = $request->iscoming == 'on';

    if($request->isActive == 'on'){
        $isActive = 1;
    }else{
        $isActive = 0;
    }
    

    
    
    

    switch ($request->coursType) {
        case 'conference':
            $additionalRules = [
                'introImageConfrence'=> ['required', 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
                'flexImageConference'=> ['required', 'file' , 'mimes:jpeg,png,jpg,gif' ,'max:2000'],
                'videoconference' => ['required', 'url'],
                'hostConference' => ['required'],
                'descriptionConference' => ['required', 'string', 'max:600'],
            ];
            break;
        case 'podcast':
            $additionalRules = [
                'introImagePodcast' => ['required', 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
                'flexImagePodcast' => ['required', 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
                'hostPodcast' => ['required'],
                'videocpodcast' => ['required', 'url'],
                'slugAcroche' => ['required', 'string', 'max:255'],
                'descriptionPodcast' => ['required', 'string', 'max:600'],
            ];
            break;
        case 'formation':
            $additionalRules = [
                'hostFormation' => ['required'],
                'programId' => ['sometimes'],
                'conditionformation' => ['sometimes', 'nullable' ,'string', 'max:600'],
                'iscertify' => ['sometimes'],
                'introImageFormation' =>  ['required', 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000' ],
                'flexImageFormation' =>  ['required', 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
                'document' => ['file' , 'mimes:pdf,jpeg,png,jpg,gif']
            ];
            break;
    }

    $request->validate($additionalRules);


    $goals = $request->gaols_id;
    $StringTag = $request->tags[0];
    $tags = explode(',', $StringTag);
    $tags = array_map('trim', $tags);

    $url = $request->videocpodcast;
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    $videoId = isset($params['v']) ? $params['v'] : null;


   
        // Create cours
        $cours = Cour::create([
            'title' => $request->title,
            'isComing' => $iscoming,
            'isActive' => $isActive,
            'description' => $request->description,
            'category_id' => $request->cotegoryId,
            'subcategory_id' => $request->subcategoryId,
            'tags' => $tags,
            'cours_type' => $request->coursType,
        ]);
        
        foreach ($goals as $key => $goal) {
            $goalCours = CoursGoals::create([
                'cours_id' => $cours->id,
                'goal_id' => $goal
            ]);
        }

// Create related model based on coursType
switch ($request->coursType) {
    case 'conference':
        $fileNameImage = $this->storeFile($request->file('introImageConfrence'), '/upload/cour/image');
        $fileNameImageFlex = $this->storeFile($request->file('flexImageConference'), '/upload/cour/image/flex');

        if ($videoId) {
            $coursCoference = CoursConference::create([
                'cours_id' => $cours->id,
                'host_id' => $request->hostConference,
                'image' => $fileNameImage,
                'image_flex' => $fileNameImageFlex,
                'video' => 'https://www.youtube.com/embed/'.$videoId,
                'duration' => $request->coursDuration,
                'description' => $request->descriptionConference
            ]);
            return redirect()->route('dashboard.create.video', $coursCoference->id);
        }else{
            return redirect()->back()->with('faild' , 'Voter Video URL est Incorrect');
        }

      
        break;
    case 'podcast':

        $fileNameImage = $this->storeFile($request->file('introImagePodcast'), '/upload/cour/image');
        $fileNameImageFlex = $this->storeFile($request->file('flexImagePodcast'), '/upload/cour/image/flex');
        
        if ($videoId) {
            $coursPodcast = CoursPodcast::create([
                'cours_id' => $cours->id,
                'host_id' => $request->hostPodcast,
                'image' => $fileNameImage,
                'image_flex' => $fileNameImageFlex,
                'video' => 'https://www.youtube.com/embed/'.$videoId,
                'duration' => $request->DurationPdcast,
                'description' => $request->descriptionPodcast,
                'slug' => $request->slugAcroche
            ]);
            return redirect()->route('dashboard.podacast.video', Crypt::encrypt($coursPodcast->id));
        }else{
            return redirect()->back()->with('faild' , 'Voter Video URL est Incorrect');
        }

      
        break;
    case 'formation':

        $fileNameImage = $this->storeFile($request->file('introImageFormation'), '/upload/cour/image');
        $fileNameImageFlex = $this->storeFile($request->file('flexImageFormation'), '/upload/cour/image/flex');

    

        $programId = ($request->programId == 0) ? null : $request->programId;
        $iscertify = $request->iscertify == 'on';
        $coursFormation = CoursFormation::create([
            'cours_id' => $cours->id,
            'host_id' => $request->hostFormation,
            'image' => $fileNameImage,
            'image_flex' => $fileNameImageFlex,
            'program_id' => $programId,
            'condition' => $request->conditionformation?? 'text',
            'isCertify' => $iscertify
        ]);

        if ($request->hasFile('document')) {
        
            $file = $request->file('document');
            
            $directory = 'upload/cour/document/';
            $fileNamedocument = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNamedocument, 'public');

            $coursFormation->update([
                'documents' => $fileNamedocument,
            ]);
        }



        if ($iscertify == false) {
            return redirect()->route('dashboard.create.video.fomation', Crypt::encrypt($coursFormation->id));
        } else {
            return redirect()->route('dashboard.create.formation.quiz', Crypt::encrypt($cours->id));
        }
        break;
    default:
        return redirect()->back()->with('status', 'vous avez crée un contenu avec seccess');
        break;
}
    
    
}

private function storeFile($file, $directory)
{
    $fileName = uniqid() . '_' . $file->getClientOriginalName();
    $file->storeAs($directory, $fileName, 'public');
    return $fileName;
}

//store short
public function store_short(Request $request)
{

    /* dd($request); */
    $request->validate([
        'title' => ['required' , 'string' , 'max:100'],
        'tags' => ['required' , 'array'],
        'image' => ['required' , 'file' , 'mimes:jpeg,png,jpg,gif', 'max:2000'],
        'video' => ['required' , 'url']
    ]);

    $StringTag = $request->tags[0];
    $tags = explode(',', $StringTag);
    $tags = array_map('trim', $tags);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $directory = '/upload/cour/image';
        $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs($directory, $fileNameImage, 'public'); 
    }

    if ($request->hasFile('imageFlex')) {
        $file = $request->file('imageFlex');
        $directory = '/upload/cour/image/flex';
        $fileNameImageflex = uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs($directory, $fileNameImageflex, 'public'); 
    }

    $url = $request->video;
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    $videoId = isset($params['v']) ? $params['v'] : null;

    if ($videoId == null) {
        return redirect()->back()->withErrors(['faild' => 'Invalid YouTube URL']);
    }

    $short = ShortCours::create([
        'title' => $request->title,
        'goal_id' => 1,
        'host_id' => $request->hostFormateur,
        'video' => 'https://www.youtube.com/embed/'.$videoId,
        'tags' => $tags,
        'image' => $fileNameImage,
        'image_flex' => $fileNameImageflex
    ]);

    $goals = $request->gaols_id;

    foreach ($goals as $key => $goal) {

        $shortGoal = ShortGoal::create([
            'cour_id' => $short->id,
            'goal_id' => $goal
        ]);
    };

   

    return redirect()->back()->with('status' , 'Vous avez Crée short');
}

//upload video cours
public function upload_video_cours(Request $request)
{
    if ($request->hasFile('introVideoConfrence')) {
        $file = $request->file('introVideoConfrence');

        $directory = '/cour';
        $fileName = $file->getClientOriginalName();

        $file->storeAs($directory, uniqid().'_'.$fileName, 's3');

        return response()->json(['success' => true]); 
    }

    return response()->json(['success' => false]); 
}







//conference cours


public function getCoursVideo(String $id){

    $conferenceId = $id;

    $Guest = UserSpeakers::where('type_speaker' , 'Conférencier')->get();

    return ['conferenceId' => $conferenceId  , 'Guest' => $Guest ];
}


    public function update_conference(Request $request)
    {

        

        $Cour = Cour::find($request->CoursId);
        $coursCoference = CoursConference::where('cours_id', $request->CoursId)->first();
        $goalCours = CoursGoals::where('cours_id' , $Cour->id)->get();


        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'description' => ['required' , 'string' , 'max:300'],
            'tags' => ['required' , 'array'],
            'descriptionConference' => ['required' , 'string' , 'max:600'],
            'cotegoryId' => ['required'],
            'goal' => ['required'],
            'hostConference' => ['required'],
            'video' => ['required' , 'url'],
            'image' => ['file' ,  'mimes:jpeg,png,jpg,gif' , 'max:2000' ]
        ]);

        $Cour->title = $request->title;

        if ($request->iscoming == 'on') {
            $iscoming = true;
         }else{
             $iscoming = false;
         }


         if ($request->isActive == 'on') {
            $isActive = true;
        }else{
            $isActive = false;
        }

       
        if ($request->hasFile('image')) {
            
            $imagePath = 'upload/cour/image/'.$coursCoference->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('image');
            $directory = 'upload/cour/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $coursCoference->image = $fileNameImage;
        }

        $Cour->isComing = $iscoming;
        $Cour->isActive = $isActive;
        $url = $request->video;

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $coursCoference->video = 'https://www.youtube.com/embed/'.$videoId;
        } 
        
       
       


        $Cour->description = $request->description;

        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;

        $Cour->category_id = $request->cotegoryId;

        $goalCours->each->forceDelete();

        foreach ($request->goal as $key => $goal) {
            $goalCours = new CoursGoals();
            $goalCours->cours_id = $Cour->id; 
            $goalCours->goal_id = $goal;
           
            $goalCours->save();
        }

       


        $coursCoference->cours_id = $request->CoursId;
        $coursCoference->host_id = $request->hostConference;
        $coursCoference->description = $request->descriptionConference;
        $coursCoference->duration = $request->coursDuration;
       


        $Cour->save();
        $coursCoference->save();
        


        return redirect()->back()->with('status' , 'Vous avez mis à jour le Conférence avec succès. ');


    }


    public function update_video_conference(String $id , Request $request)
    {
        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'guestIds' => ['required'],
            'videoTags' => ['required'],
            'videoduration' => ['required'],
            'video' => ['required' , 'url'],
            'imagevideo' => ['file' ,  'mimes:jpeg,png,jpg,gif' , 'max:2000']
        ]);
        $url = $request->video;

       

        if ($request->hasFile('imagevideo')) {
            $imagePath = 'upload/cour/video/image/'.$video->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('imagevideo');
            $directory = 'upload/cour/video/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $video->image = $fileNameImage;
        }

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $video->video = 'https://www.youtube.com/embed/'.$videoId;
        } 

        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);




        $video->coursconference_id = $request->confrenceId;
        $video->title = $request->titleVideo;
        $video->description = $request->descriptionVideo;
        $video->tags = $tags;
        $video->duration = $request->videoduration;
        
        $video->guestvideo()->forceDelete();
        
        foreach ($request->guestIds as $guestId) {
            $video->guestvideo()->create(['guest_id' => $guestId]);
        
        }
        $video->save();

        return redirect()->back()->with('status' , 'Vous avez mis à jour la vidéo de conférence avec succès.');

    }
    


    public function store_video(Request $request){
      
        
        $request->validate([
            'titleVideo' => ['required', 'string', 'max:255'],
            'descriptionVideo'  => ['required', 'string', 'max:100'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'videoTags' => ['required', 'array'],
            'guestIds' => ['required'],
            'videoConference' => ['sometimes' , 'url']
        ]);

        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/upload/cour/video/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public'); 
        }
      

        

        $url = $request->videoConference;
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        $videoId = $params['v'];
        
        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);


        $conferenceVideos = CoursConferenceVideo::create([
            'coursconference_id' => $request->confrenceId,
            'title' => $request->titleVideo,
            'description' => $request->descriptionVideo,
            'image' => $fileNameImage,
            'tags' => $tags,
            'duration' => $request->videoduration,
            'video' => 'https://www.youtube.com/embed/'.$videoId
        ]);

        foreach ($request->guestIds as $key => $guest) {
            $guestVideo = CoursConferenceGuest::create([
                'coursconferencevideo_id' => $conferenceVideos->id,
                'guest_id' => $guest
            ]);
        }

        $output = '';

        $getConferenceVideos = CoursConferenceVideo::where('coursconference_id' , $request->confrenceId)->get();

        foreach ($getConferenceVideos as $key => $video) {

            $output .= view('Cours.create.conference.videoCrad')->with(['video' => $video , 'guestVideo' => $guestVideo ])->render();
        }

        return response()->json(['output' => $output]);

    }


    public function delete_video(String $id){

        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));

        $guests = CoursConferenceGuest::where('coursconferencevideo_id', $video->id)->get();

        foreach ($guests as $key => $guest) {
            $guest->forceDelete();
        }
        
        $video->forceDelete();
        $imagePath = 'upload/cour/video/image/'.$video->image;
        Storage::disk('public')->delete($imagePath);
        return response()->json(['message' => 'CoursConferenceVideo and associated records deleted successfully']);

    }

    public function delete_video_update(String $id , Request $request){

        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));


    
        if(Hash::check( $request->password, Auth::user()->password )){
            $video->delete();

            $video->guestvideo()->Delete();
    
            return redirect()->back()->with('status' , 'u have deleted video');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }

      

    }
    

    //delete cours conference

    public function delete_conference(Request $request , String $id)
    {
        $coursConference = CoursConference::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            $coursConference->delete();
            $coursConference->cours->delete();
            $coursConference->ConferenceVideo->each->delete();
        }
        return redirect()->route('dashboard.cours.index')->with('status' , 'you have deleted a cours');

    }




    // podcast cours

    public function getPodcastVideo(String $id)
    {
        $podcastId = Crypt::decrypt($id);

        $GuestPodcast = UserSpeakers::where('type_speaker' , 'Invité')->get();

        return ['podcastId' => $podcastId   , 'GuestPodcast' => $GuestPodcast];

    }

    public function update_podcast(String $id , Request $request)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));
        $CourPodcast = CoursPodcast::where('cours_id' , $Cour->id)
        ->first();
        $goalCours = CoursGoals::where('cours_id' , $Cour->id)->get();
        

        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'description' => ['required' , 'string' , 'max:300'],
            'tags' => ['required' , 'array'],
            'cotegoryId' => ['required' , 'string'],
            'subcategoryId' => ['required'],
            'goal' => ['required' , 'array'],
            'coursDuration' => ['required'],
            'slugAcroche' => ['required' , 'string' , 'max:100'],
            'descriptionPodcast' => ['required' , 'string' , 'max:600'],
            'image' => ['file' ,  'mimes:jpeg,png,jpg,gif', 'max:2000']
        ]);

        $url = $request->video;

       

        if ($request->hasFile('image')) {
            $imagePath = 'upload/cour/image/'.$CourPodcast->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('image');
            $directory = 'upload/cour/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $CourPodcast->image = $fileNameImage;
        }
        if ($request->hasFile('coursImageflex')) {
            $imagePath = 'upload/cour/image/flex/'.$CourPodcast->image_flex;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('coursImageflex');
            $directory = 'upload/cour/image/flex/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $CourPodcast->image_flex = $fileNameImage;
        }

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $CourPodcast->video = 'https://www.youtube.com/embed/'.$videoId;
        }



        $Cour->title = $request->title;

        if ($request->iscoming == 'on') {
            $iscoming = true;
         }else{
             $iscoming = false;
         }


         if ($request->isActive == 'on') {
            $isActive = true;
        }else{
            $isActive = false;
        }

        $Cour->isComing = $iscoming;
        $Cour->isActive = $isActive;

        $Cour->description = $request->description;

        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;
        $Cour->category_id = $request->cotegoryId;
        $Cour->subcategory_id = $request->subcategoryId;

       
        $goalCours->each->forceDelete();
        foreach ($request->goal as $key => $goal) {
            $goalCours = new CoursGoals();
            $goalCours->cours_id = $Cour->id; 
            $goalCours->goal_id = $goal;
           
            $goalCours->save();
        }
        
        $CourPodcast->host_id = $request->hostPodcast;
        $CourPodcast->slug = $request->slugAcroche;
        $CourPodcast->description = $request->descriptionPodcast;
        $CourPodcast->duration = $request->coursDuration;

        $Cour->save();
        $CourPodcast->save();

        return redirect()->back()->with('status' , 'Vous avez mis à jour le podcast avec succès.');



    }


    public function store_videoPodacast(Request $request){

       
        $request->validate([
            'titleVideo' => ['required', 'string', 'max:255'],
            'descriptionVideo'  => ['required', 'string', 'max:100'],
            'image' => ['required' ,'file' ,  'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'videoTags' => ['required', 'array'],
            'guestIds' => ['sometimes', 'nullable'],
            'videoPodcast' => ['sometimes' , 'url']
        ]);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/upload/cour/video/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public'); 
        }

        $iscoming = $request->iscoming == 'on';

        $url = $request->videoPodcast;
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        $videoId = $params['v'];
    

        foreach ($request->videoTags as $key => $videoTag) {
            $videoTags[] = $videoTag;
        }


        $conferenceVideos = CoursPadcastVideo::create([
            'podacast_id' => $request->podcastId,
            'title' => $request->titleVideo,
            'image' => $fileNameImage,
            'description' => $request->descriptionVideo,
            'iscoming' => $iscoming,
            'tags' => $videoTags,
            'video' => 'https://www.youtube.com/embed/'.$videoId ,
            'duration' => $request->videoduration
        ]);

        foreach ($request->guestIds ?? [] as $key => $guest) {
            $guestVideo = CoursPadcastGuest::create([
                'podcastvideo_id' => $conferenceVideos->id,
                'guest_id' => $guest
            ]);
        }
        
        $output = '';

        $getPodcastVideos = CoursPadcastVideo::where('podacast_id' , $request->podcastId)->get();

        foreach ($getPodcastVideos as $key => $video) {

            $output .= view('Cours.create.podcast.videoCard')->with(['video' => $video])->render();
        }
       

        return response()->json(['output' => $output]);

    }


    public function update_video_podcast(String $id , Request $request)
    {
        $videoPodcast = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));


        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'videoTags' => ['required' , 'array'],
            'image' => ['file' ,  'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'videoduration' => ['required'],
            'video' => ['required' , 'url']
        ]);
        $iscoming = $request->iscoming == 'on';
        $url = $request->video;

        if ($request->hasFile('image')) {
            $imagePath = 'upload/cour/video/image/'.$videoPodcast->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('image');
            $directory = 'upload/cour/video/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $videoPodcast->image = $fileNameImage;
        }

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $videoPodcast->video = 'https://www.youtube.com/embed/'.$videoId;
        }


        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $videoPodcast->title = $request->titleVideo;
        $videoPodcast->description = $request->descriptionVideo;
        $videoPodcast->tags = $tags;
        $videoPodcast->duration = $request->videoduration;
        $videoPodcast->iscoming = $iscoming;

        
        
    
        $videoPodcast->guestvideo()->forceDelete();

        // Check if guestIds is provided in the request and is an array
        if ($request->has('guestIds') && is_array($request->guestIds)) {
            foreach ($request->guestIds as $guestId) {
                $videoPodcast->guestvideo()->create(['guest_id' => $guestId]);
            }
        }
        
        $videoPodcast->save();
       
        return redirect()->back()->with('status' , 'Vous avez mis à jour la vidéo de podcast avec succès.');

    }


    public function delete_video_podcast(String $id){

        $video = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));

        // Delete associated guest videos first
        $guests = CoursPadcastGuest::where('podcastvideo_id', $video->id)->get();
        if (!$video->guestvideo->isEmpty()) {
            foreach ($guests as $key => $guest) {
                $guest->forceDelete();
            }
        }
       
       
      
        // Now delete the CoursConferenceVideo instance
        $video->forceDelete();

        $imagePath = 'upload/cour/video/image/'.$video->image;
        Storage::disk('public')->delete($imagePath);

        return response()->json(['message' => 'CoursPodcastVideo and associated records deleted successfully']);

    }


    public function deleteVidoe_podcast_update(String $id , Request $request){

        $video = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            $video->delete();


            foreach ($video->guestvideo as $key => $guest) {
                $guest->Delete();
            }

            
    
            return redirect()->back()->with('status' , 'u have deleted video');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }

    }


     //delete cours podcast

     public function delete_padcast(Request $request , String $id)
     {
         $courpodcast = CoursPodcast::findOrFail(Crypt::decrypt($id));
 
         if(Hash::check( $request->password, Auth::user()->password )){
             $courpodcast->delete();
             $courpodcast->cours->delete();
             $courpodcast->videopodcast->each->delete();
         }
         return redirect()->route('dashboard.cours.index', ['status' => 'you have deleted a cours']);
 
     }
 

    // crud fomation

    public function update_formation(String $id, Request $request)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));
        $coursFormation = CoursFormation::where('cours_id', $Cour->id)
        ->with('user')
        ->first();
        $goalCours = CoursGoals::where('cours_id', $Cour->id)->get();

        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:300'],
            'tags' => ['required', 'array'],
            'cotegoryId' => ['required', 'string'],
            'subcategoryId' => ['required'],
            'goal' => ['required', 'array'],
            'conditionformation' => ['sometimes', 'string', 'max:600'],
            'image' => ['file', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'document' => ['file', 'mimes:pdf', 'max:2000']
        ]);

        if ($request->hasFile('image')) {
            $imagePath = 'upload/cour/image/'.$coursFormation->image;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $file = $request->file('image');
            $directory = 'upload/cour/image/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            $coursFormation->image = $fileNameImage;
        }

        if ($request->hasFile('ImageFomationflex')) {
            $imagePath = 'upload/cour/image/flex/'.$coursFormation->image_flex;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $file = $request->file('ImageFomationflex');
            $directory = 'upload/cour/image/flex/';
            $fileNameImageflex = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImageflex, 'public');
            $coursFormation->image_flex = $fileNameImageflex;
        }

        if ($request->hasFile('document')) {
            $imagePath = 'upload/cour/document/'.$coursFormation->documents;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $file = $request->file('document');
            $directory = 'upload/cour/document/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            $coursFormation->documents = $fileNameImage;
        }

        $Cour->title = $request->title;
        $Cour->isComing = $request->iscoming == 'on';
        $Cour->isActive = $request->isActive == 'on';
        $Cour->description = $request->description;
        

        $StringTag = $request->tags[0];
        $tags = array_map('trim', explode(',', $StringTag));
        $Cour->tags = $tags;
        $Cour->category_id = $request->cotegoryId;
        $Cour->subcategory_id = $request->subcategoryId;

        $goalCours->each->forceDelete();
        foreach ($request->goal as $goal) {
            $newGoal = new CoursGoals();
            $newGoal->cours_id = $Cour->id;
            $newGoal->goal_id = $goal;
            $newGoal->save();
        }

        if ($request->has('conditionformation')) {
            $coursFormation->condition = $request->conditionformation;
        }

        $coursFormation->host_id = $request->hostPodcast;
        $coursFormation->program_id = $request->programId;

        $Cour->save();
        $coursFormation->save();

        return redirect()->back()->with('status' , 'Vous avez mis à jour la formation avec succès.' );
    }


    //download document formation
    public function download_document($filename)
    {

         $filePath = public_path('/storage/upload/cour/document/' . $filename);

         
         if (file_exists($filePath)) {
             return response()->download($filePath);
         } else {
             return redirect()->back()->with('faild', 'File not found.');
         }

    }


    public function getvideoformation(String $id)
    {
        $formationId = Crypt::decrypt($id);

        return ['formationId' => $formationId];
    }

    public function create_video_formation(String $id)
    {
        $courId = CoursFormation::findOrFail(Crypt::decrypt($id));

        $couvideo = CoursFormationVideo::where('CourFormation_id' , $courId->id)->get();


        $checkCountRate = QuizSeccesseVideo::whereIn('video_id' , $couvideo->pluck('id'))->first();

        return view('Cours.create.fomation.formationvideo')->with(['courId' => $courId , 
        'couvideo' => $couvideo , 'checkCountRate' => $checkCountRate]);
    }

    //update video formation
    public function update_video_formation(String $id,Request $request){

        $videoforamtion = CoursFormationVideo::findOrFail(Crypt::decrypt($id));
        
        
        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'videoTags' => ['required' , 'array'],
            'imagevideo' => ['file' ,  'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'video' => ['required' , 'url']
        ]);
        $iscoming = $request->iscoming == 'on';
        $url = $request->video;

        if ($request->hasFile('image')) {
            $imagePath = 'upload/cour/video/image/'.$coursFormation->image;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('image');
            $directory = 'upload/cour/video/image/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $videoforamtion->image = $fileNameImage;
        }

        if (strpos($url, 'watch?v=') !== false) {
          
            $queryString = parse_url($url, PHP_URL_QUERY);
            parse_str($queryString, $params);
            $videoId = $params['v'];
            $videoforamtion->video = 'https://www.youtube.com/embed/'.$videoId;
        }


        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $videoforamtion->title = $request->titleVideo;
        $videoforamtion->description = $request->descriptionVideo;
        $videoforamtion->tags = $tags;
        $videoforamtion->iscoming = $iscoming;

        $videoforamtion->save();


        return redirect()->back()->with('status' , 'Vous avez mis à jour video formation avec succès.');

    }


    public function store_video_formation(Request $request)
    {

        $courFormationId = $request->courFormationId;

        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'image' => ['required' , 'file' , 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'videoFormation' => ['sometimes' , 'url'],
            'videoTags' => ['required' , 'array'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/upload/cour/video/image';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public'); 
        }

        if ($request->hasFile('document')) {
            $imagePath = 'upload/cour/document/'.$coursFormation->documents;
            Storage::disk('public')->delete($imagePath);
           
            $file = $request->file('document');
            $directory = 'upload/cour/document/';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public');
            
            $coursFormation->documents = $fileNameImage;
        }

        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $url = $request->videoFormation;
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        $videoId = $params['v'] ?? null;
        $iscoming = $request->iscoming == 'on';

        if ($videoId === null) {
            return redirect()->back()->with(['faild' => 'The YouTube URL should be like this https://www.youtube.com/watch?v= contain the video ID parameter.'], 400);
        }

        $video = CoursFormationVideo::create([
        'CourFormation_id' => $courFormationId,
        'title' => $request->titleVideo,
        'description' =>$request->descriptionVideo ,
        'image' => $fileNameImage,
        'tags'=> $tags,
        'iscoming' => $iscoming,
        'video' => 'https://www.youtube.com/embed/'.$videoId,
        ]);

        return redirect()->back()->with('status' , 'Vous Avez Crée video');

    }

    //store quiz video formation

    public function store_video_quiz_formation(Request $request )
    {
        $courvideoId = $request->courvideoId;

        $checkCountRate = QuizSeccesseVideo::where('video_id' , $courvideoId)->first();

        $request->validate([
            'Question' => ['required' , 'string' , 'max:200'],
            'RightAwnser' => ['required' , 'string' , 'max:200'],
        ]);


        if( $request->Rate < $request->count ){

            $Question = Question::create([
                'question' => $request->Question
            ]);
    
            $RightAnswer = Answer::create([
                'Question_id' => $Question->id,
                'Answer' => $request->RightAwnser
            ]);
    
            $allAnswers = $request->awnser;
    
            foreach ($allAnswers as $key => $Answer) {
                $Answers =  Answer::create([
                    'Question_id' => $Question->id,
                    'Answer' => $Answer
                ]);
            }


            if($checkCountRate){
                
                $QuizSeccess = QuizSeccesseVideo::create([
                    'video_id' => $courvideoId,
                    'question_id' => $Question->id,
                    'answer_id' => $RightAnswer->id,
                    'rateSeccess' => $checkCountRate->rateSeccess,
                    'Answercount' => $checkCountRate->Answercount
                ]);
        
            }else{
                $QuizSeccess = QuizSeccesseVideo::create([
                    'video_id' => $courvideoId,
                    'question_id' => $Question->id,
                    'answer_id' => $RightAnswer->id,
                    'rateSeccess' => $request->Rate,
                    'Answercount' => $request->count
                ]);
            }
            
            return redirect()->back()->with('QuizSeccess' , $QuizSeccess);


        }else{
            $message = 'Votre Rate bigger than count' ;
            return response()->json($message); 
        }

    }
    //delete video formation

    public function delete_video_formation(String $id)
    {
        $video = CoursFormationVideo::findOrFail(Crypt::decrypt($id));

        $video->forceDelete();

        $imagePath = 'upload/cour/video/image/'.$video->image;
        Storage::disk('public')->delete($imagePath);

        return response()->json(['message' => 'Cours Formation Video has been deleted']);

    }

    //delete updated video formation

    public function delete_update_video_formation(String $id , Request $request){
        $video = CoursFormationVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            
            $video->delete();
    
            return redirect()->back()->with('status' , 'u have deleted video formation');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }
    }

    public function update_quiz_formation(String $id , Request $request)
    {
        $Qsm = QuizSeccess::findOrFail(Crypt::decrypt($id));

        $Question = Question::where('id' , $Qsm->question_id)->first();
        $RightAnswer = Answer::where('id' , $Qsm->answer_id)->first();

        $request->validate([
                'Question' => ['required' , 'string' , 'max:200'],
                'RightAwnser' => ['required' , 'string' , 'max:200'],
                'Rate' => ['required' , 'integer' ],
                'count' => ['required' , 'integer'],
                'awnser' => ['required']
            ]);


            $Question->question = $request->Question;
            $RightAnswer->Answer = $request->RightAwnser;
            $Qsm->rateSeccess = $request->Rate;
            $Qsm->Answercount = $request->count;
            
            $answersData = $request->input('awnser', []);
            
            foreach ($Qsm->Question->Answers as $index => $Answer) {
                if (isset($answersData[$index])) {
                    $Answer->answer = $answersData[$index];
                    $Answer->save();
                }
            }
            

            $RightAnswer->save();
            $Question->save();
            $Qsm->save();

            return redirect()->back()->with('status' , 'u have updated quiz');


    }


    // update Question Formation

    public function update_Question_formation(String $id ,Request $request)
    {

        $Questionnair = QuizQuestion::findOrFail(Crypt::decrypt($id));
        $request->validate([
            'Question' => ['required' , 'string' , 'max:200'],
        ]);


        $Questionnair->Question = $request->Question;

        $Questionnair->save();
        
        return redirect()->back()->with('status' , 'updated Questionnair');
    }


    public function create_quiz_formation( String $id){
        $courId = Crypt::decrypt($id);
        $coursFormationId = CoursFormation::where('cours_id' , $courId)->first();

        $Qsms = QuizSeccess::where('cours_id' , $courId)->get();

        $checkCountRate = QuizSeccess::where('cours_id' , $courId)->first();
       
        return view('Cours.create.fomation.quiz')->with(['courId' => $courId ,
        'coursFormationId' => $coursFormationId , 'Qsms' => $Qsms , 'checkCountRate' => $checkCountRate]);
    }

    public function store_quiz_formation(Request $request)
    {
        $courId = $request->courId;

        $CourFormation = CoursFormation::where('cours_id' , $courId)->first();
        $checkCountRate = QuizSeccess::where('cours_id' , $courId)->first();

        $request->validate([
            'Question' => ['required' , 'string' , 'max:200'],
            'RightAwnser' => ['required' , 'string' , 'max:200'],
        ]);

        $CourFormation->update([
            'quiz_type' => 0
        ]);


        if( $request->Rate < $request->count ){

            $Question = Question::create([
                'question' => $request->Question
            ]);
    
            $RightAnswer = Answer::create([
                'Question_id' => $Question->id,
                'Answer' => $request->RightAwnser
            ]);
    
            $allAnswers = $request->awnser;
    
            foreach ($allAnswers as $key => $Answer) {
                $Answers =  Answer::create([
                    'Question_id' => $Question->id,
                    'Answer' => $Answer
                ]);
            }


            if($checkCountRate){
                
                $QuizSeccess = QuizSeccess::create([
                    'cours_id' => $courId,
                    'question_id' => $Question->id,
                    'answer_id' => $RightAnswer->id,
                    'rateSeccess' => $checkCountRate->rateSeccess,
                    'Answercount' => $checkCountRate->Answercount
                ]);
        
            }else{
                $QuizSeccess = QuizSeccess::create([
                    'cours_id' => $courId,
                    'question_id' => $Question->id,
                    'answer_id' => $RightAnswer->id,
                    'rateSeccess' => $request->Rate,
                    'Answercount' => $request->count
                ]);
            }

           
            

            return redirect()->back(); 

        }else{
            return redirect()->back()->with('faild' , 'Votre Rate bigger than count'); 
        }

      
        
    }

    public function store_quiz_qustion(Request $request){
        $courId = $request->courId;

        $CourFormation = CoursFormation::where('cours_id' , $courId)->first();

        $request->validate([
            'Question' => ['required']
        ]);

        $Questions = $request->Question;

        

        foreach ($Questions as $key => $Question) {
          
            $createdQuestion = QuizQuestion::create([
                'cours_id' => $courId,
                'Question' => $Question
            ]);
    
        }

        
        $CourFormation->update([
            'quiz_type' => 1
        ]);

        $getCreatedQuestion = QuizQuestion::where('cours_id' , $request->courId)->get();
        $output = '';

        $output = view('Cours.create.fomation.cardQuestion', ['questions' => $getCreatedQuestion])->render();

        return response()->json([$output]);

       
    }



    public function delete_Qsm_formation(String $id)
    {
        $question = Question::findOrFail(Crypt::decrypt($id));

        $question->quizSeccess()->forceDelete(); 
    
        $question->Answers()->forceDelete();
        $question->forceDelete();
    
        return redirect()->back();
    }


    //delete updated Qsm
    public function delete_Qsm_updated_formation(String $id , Request $request)
    {

        $Qsm = Question::findOrFail(Crypt::decrypt($id));

       

        if(Hash::check( $request->password, Auth::user()->password )){

            $Qsm->Answers()->delete(); 
            $Qsm->QuizSeccess()->delete();
    
            $Qsm->delete();
    
            return redirect()->back()->with('status' , 'u have deleted Qsm');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }
    }


    public function delete_Qustion_farmation(String $id)
    {
        $Question = QuizQuestion::findOrFail(Crypt::decrypt($id));


        $Question->forceDelete();

        return response()->json(['message' => 'Question deleted successfully'], 200);
    }

    //delete Questionnair Formation
    public function delete_Question_updated_formation(String $id , Request $request)
    {

        $Question = QuizQuestion::findOrFail(Crypt::decrypt($id));
       
        if(Hash::check( $request->password, Auth::user()->password )){

            $Question->delete(); 
    
            return redirect()->back()->with('status' , 'u have deleted Question');

        }else{

            return redirect()->back()->with('status' , 'u password is incorrect');

        }
    }


    //delete cours formation

    public function delete_formation(Request $request , String $id)
    {
        $courformation = CoursFormation::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            $courformation->delete();
            $courformation->cours->delete();
            $courformation->CoursFormationVideo->each->delete();
        }
        return redirect()->route('dashboard.cours.index')->with('status' , 'you have deleted a cours');

    }


    // cours history
    public function cours_history()
    {
        $cours = Cour::onlyTrashed()->get();
        $shorts = ShortCours::onlyTrashed()->get();
        $Category = Category::onlyTrashed()->get();
        $SubCategory = SousCategory::onlyTrashed()->get();
        $Programs = Program::onlyTrashed()->get();
        $Objectives = Goal::onlyTrashed()->get();


        return view('Hisotry.show')->with(['cours' => $cours , 'shorts' => $shorts ,
        'Category' => $Category , 'SubCategory' => $SubCategory , 'Programs' => $Programs , 
        'Objectives' => $Objectives]);
    }

    //restore history cours
    public function restore_history_cours(String $id)
    {
        $cours = Cour::withTrashed()->findOrFail(Crypt::decrypt($id));
       
        
        if($cours->cours_type == 'conference'){
            $cours->restore();
            $coursConference = CoursConference::withTrashed()->where('cours_id' , $cours->id)->restore();
        }elseif($cours->cours_type == 'podcast'){
            $cours->restore();
            $coursPodcast = CoursPodcast::withTrashed()->where('cours_id' , $cours->id)->restore();
        }else{
            $cours->restore();
            $coursFormation = CoursFormation::withTrashed()->where('cours_id' , $cours->id)->restore();
        }

        return redirect()->back()->with('status' , 'Vous Restore votre Cours');

    }

    

   
    
    
    //restore Speaker
    public function restore_history_speaker(String $id)
    {
        $cours = Cour::withTrashed()->findOrFail(Crypt::decrypt($id));
       
        
        if($cours->cours_type == 'conference'){
            $cours->restore();
            $coursConference = CoursConference::withTrashed()->where('cours_id' , $cours->id)->restore();
        }elseif($cours->cours_type == 'podcast'){
            $cours->restore();
            $coursPodcast = CoursPodcast::withTrashed()->where('cours_id' , $cours->id)->restore();
        }else{
            $cours->restore();
            $coursFormation = CoursFormation::withTrashed()->where('cours_id' , $cours->id)->restore();
        }

        return redirect()->back()->with('status' , 'Vous Restore votre Cours');

    }
    //restore Manager
    public function restore_history_manager(String $id)
    {
        $cours = Cour::withTrashed()->findOrFail(Crypt::decrypt($id));
       
        
        if($cours->cours_type == 'conference'){
            $cours->restore();
            $coursConference = CoursConference::withTrashed()->where('cours_id' , $cours->id)->restore();
        }elseif($cours->cours_type == 'podcast'){
            $cours->restore();
            $coursPodcast = CoursPodcast::withTrashed()->where('cours_id' , $cours->id)->restore();
        }else{
            $cours->restore();
            $coursFormation = CoursFormation::withTrashed()->where('cours_id' , $cours->id)->restore();
        }

        return redirect()->back()->with('status' , 'Vous Restore votre Cours');

    }



    //restore history short
    public function restore_history_short(String $id)
    {
        $short = ShortCours::withTrashed()->findOrFail(Crypt::decrypt($id));

        $short->restore();
  
        return redirect()->back()->with('status' , 'Vous Restore votre Quickly');
  
    }


    //crud tickets
    public function create_tickets()
    {
        $users = UserRole::where('role_id' , 4)->get();
        $tickets = Ticket::all();

        return view('Tickets.create')->with(['users' => $users , 'tickets' => $tickets]);
    }

    public function store_ticket(Request $request)
    {
        
        $request->validate([
            'type_ticket' => ['required' , 'string' , 'max:100'],
            'user' => ['required'],
            'detail' => ['required' , 'string' , 'max:500'],
            'file' => ['file' , 'mimes:jpeg,png,jpg,gif,pdf' , 'max:2000'],
        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $directory = '/ticket';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public'); 
        } 

        $ticket = Ticket::create([
            'user_id' => $request->user,
            'manager_id' => Auth::user()->id,
            'Type_Ticket' => $request->type_ticket,
            'status' => false,
            'detail' => $request->detail,
        ]);

        $fileticket = TicketFile::create([
            'ticket_id' => $ticket->id,
            'file' => $fileNameImage
        ]);

        return redirect()->back()->with('status' , 'Vous avez Crée Ticket');
    }

    public function edite_ticket(String $id)
    {
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
    
        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first(); 
    
        $outhertickets = CommentTicket::where('id', '!=', optional($personnaleTicket)->id)->get();
    
        $userclients = UserRole::where('role_id' , 4)->get();
    
        return view('Tickets.edite')->with([
            'ticket' => $ticket , 
            'userclients' => $userclients , 
            'personnaleTicket' => $personnaleTicket ,   
            'outhertickets' => $outhertickets
        ]);
    }
    
    public function update_ticket(String $id , Request $request)
    {
        
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        
        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first(); 
        $request->validate([
            'status' => ['required' , 'boolean' ],
            'detail' => ['required' , 'string' , 'max:500'],
        ]);
    
        $ticket->manager_id = Auth::user()->id;
        $ticket->status = $request->status;
        $ticket->detail = $request->detail;
        if ($personnaleTicket) {
            $personnaleTicket->comment = $request->comment;
            $personnaleTicket->save();
        }
    

        $ticket->save();
        

        return redirect()->back()->with('status' , 'Vous Modifier Votre Ticket');

    }

    public function store_ticketComment(String $id , Request $request)
    {


        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        
        $personnaleTicketupdate = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first();
        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->exists();
        


        if($personnaleTicket){
            $personnaleTicketupdate->update([
                'comment' => $request->comment
            ]);
        }else{
            $ticketComment = CommentTicket::create([
                'user_id' => Auth::user()->id,
                'ticket_id' => $ticket->id,
                'comment' => $request->comment
            ]);
        }

       

        return redirect()->back();

    }


    //FAQ

    public function FAQ_edite()
    {

        $FAQs = FAQ::all();

        return view('FAQ.faq')->with('FAQs' , $FAQs);
    }

    public function FAQ_store(Request $request)
    {
        $request->validate([
            'Question' => ['required' , 'string' , 'max:255'],
            'answer' => ['required' , 'string' , 'max:500']
        ]);

        $FAQ = FAQ::create([
            'question' => $request->Question,
            'answer' => $request->answer
        ]);


        return redirect()->back()->with('status' , 'Vous Avez Crée FAQ');
    }

    public function FAQ_update(Request $request , String $id)
    {
        $FAQ = FAQ::findOrFail(Crypt::decrypt($id));

        $FAQ->update([
            'question' => $request->Question,
            'answer' => $request->answer
        ]);

        return redirect()->back()->with('status' , 'Vous Avez Modifier FAQ');
    }


    //emails

    public function Create_email()
    {

        $users = User::all();
        return view('SendEmail.email')->with('users' , $users);
    }

    public function send_emails(Request $request)
    {

        $requestemail = $request->all();

        foreach ($requestemail['users'] as $key => $user) {

            Mail::To($user)->send(new sendemail($requestemail));

        }
      
        return redirect()->back()->with('status', 'Vous avez Envoyer l\'Email');
    }

    //crud event

    public function event(){
        $events = Event::paginate(10);

        return view('Cours.show.Event')->with('events' , $events); 

    }

    public function create_event()
    {
        $Speakers = UserSpeakers::all();

        return view('Cours.create.event')->with('Speakers' , $Speakers);
    }

    public function event_show(Request $request , String $id){
        $event = Event::findOrFail(Crypt::decrypt($id));

        return view('Cours.detail.event')->with('event' , $event);
    }

    public function store_event(Request $request)
    {


        $request->validate([
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['required' , 'string' , 'max:300'],
            'speakerID' => ['sometimes' , 'array'],
            'datestart' => ['required' , 'string' , 'max:255'],
            'Dateend' =>  ['required' , 'string' , 'max:255'],
            'image' => ['required' , 'file'],
            'url' => ['required' , 'url']
        ]);

     
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/upload/event';
            $fileNameImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameImage, 'public'); 
        }


        $formattedDateStart = Carbon::parse($request->datestart)->formatLocalized('%a, %d %b %Y %I:%M %p');
        $formattedDateEnd = Carbon::parse($request->datestart)->formatLocalized('%a, %d %b %Y %I:%M %p');

        $event = Event::create([
            'image' => $fileNameImage,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'date_start' => $formattedDateStart,
            'date_end' => $formattedDateEnd
        ]);

        if ($request->has('speakerID')) {
            foreach ($request->speakerID as $speakerId) {
                UserEvent::create([
                    'host_id' => (int)$speakerId,
                    'event_id' => $event->id
                ]);
            }
        }
    
        return redirect()->back()->with('status', 'Event created successfully');

    }





}