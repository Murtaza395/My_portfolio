<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function register(){
        return view('user.register');
    }
    public function index(){
        $profile = Profile::where('user_id',Auth::user()->id)->count();
        $profilecount=$profile>0;
        $profiles = Profile::all();
        $user = User::with('project')->get();
        $project = Project::where('user_id',Auth::user()->id)->get();
        return view('user.index',[
            'profile'=> $profile,
            'user'=> $user,
            'profilecount'=> $profilecount,
            'profiles'=> $profiles,
            'project'=> $project
            ]);
    }
    public function login(){
        return view('user.login');
    }
    public function processLogin(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=> 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
    }
        if(Auth::attempt(['email'=> $request->email,'password'=> $request->password])){
        return redirect()->route('user.home')->with('success','Logged in successfully');
    }
    else{
        Auth::logout();
        return redirect()->back()->with('error','Wrong credentials');
    }
}

public function processRegister(Request $request){
    $rules=[
        'email'=> 'required|email|unique:users',
        'fname'=>'required',
        'lname'=>'required',
        'gender'=>'required',
        'password'=> 'required|confirmed',
        'password_confirmation'=>'required'
    ];
    if(!empty($request->pic)){
        $rules['image']='image';
    }
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name =$request->fname .' '.$request->lname;
        $user->gender=$request->gender;
        $user->save();

        if(!empty($request->pic)){
            $image=$request->pic;
            $ext=$image->getClientOriginalExtension();
            $imageName=time().'.'.$ext;
            $image->move(public_path('uploads/profile/'), $imageName);
            $user->profile_pic=$imageName;
            $user->save();

            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/profile/'.$imageName));
            $img->cover(150, 150);
            $img->save(public_path('uploads/profile/thumb/'.$imageName));
        }
        return redirect()->route('user.login')->with('success','You have been Registered successfully');
    }
    public function logout(){
        if(Auth::check()){
        Auth::logout();
        return redirect()->route('user.login');
    }
}
public function changeDP($id){
    $user = User::find($id);
    return view('user.changeProfile');
}
public function processChangeDP($id,Request $request){
    $rules=[''];
    if(!empty($request->image)){
            $rules['image']='image';
    }
    $validator=Validator::make($request->all(),$rules);
    if($validator->fails()){
        return redirect()->back();
    }
    if(!empty($request->image)){
    File::delete(public_path('uploads/profile/'.Auth::user()->profile_pic));
    File::delete(public_path('uploads/profile/thumb/'.Auth::user()->profile_pic));
    $user = User::find($id);
    $image = $request->image;
    $ext =$image->getClientOriginalExtension();
    $imageName = time().'.'.$ext;
    $image->move(public_path('uploads/profile/'),$imageName);
    $user->profile_pic = $imageName;
    $user->save();

    $manager = new ImageManager(new Driver());
    $img = $manager->read('uploads/profile/'. $imageName);
    $img->cover(150,150);
    $img->save(public_path('uploads/profile/thumb/'.$imageName));

    }
    return redirect()->route('user.dashboard')->with('success','Picture updated successfully');
}
    public function changePass($id){
        $user = User::find($id);
        return view('user.changePass');
    }
    public function processChangePass($id,Request $request){
        $validator = Validator::make($request->all(),[
            'current_password' =>'required',
            'password'=>'required|confirmed',
            'password_confirmation' =>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors( $validator );
        }
        $user = User::findOrFail($id);
       if( Hash::make($request->current_password==$user->password ) && $request->password == $request->password_confirmation ) {
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect()->route('user.login')->with('Your password has been updated successfully');
          }
         else{
        return redirect()->back()->withInput()->withErrors( $validator );
              }
    }
}
