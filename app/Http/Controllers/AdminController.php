<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        $user = User::where('usertype','users')->get()->count();
        $project =Project::all()->count();
        $pro =Project::all();
        return view('admin.index',[
            'user'=> $user,
            'project'=> $project,
            'pro'=> $pro
        ]);
    }
    public function login(){
        return view('admin.login');
    }
    public function processLogin(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=> 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
    }
        if(Auth::guard('admin')->attempt(['email'=> $request->email,'password'=> $request->password])){
            if(Auth::guard('admin')->user()->usertype!='admin'){
                Auth::guard('admin')->logout();
                return redirect()->back()->withErrors('error','you are not authorize to access this');
            }
            else{
            return redirect()->route('admin.dashboard')->with('success','Logged in successfully');
            }
    }
    else{
        return redirect()->back()->with('error','Wrong credentials');
    }
}

public function logout(){
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
}
public function allProjects($id,Request $request){
    $pro = Project::all();
    $search=$request->search;
    $project = Project::Select("*")->where('id',$id);
    $project=$project->where('name','LIKE','%'.$search.'%')->orderBy('created_at','DESC');
    $project =$project->paginate('1');
    return view('admin.allProjects',[
        'project'=> $project,
        'search'=> $search,
        'pro'=> $pro,


    ]);
}
public function deleteProject($id){
    $project = Project::find($id);
    $project->delete();
    return redirect()->route('admin.dashboard')->with('success','Project deleted successfully');

}
    public function changePass($id){
        $user = User::find($id);
        $pro =Project::all();
        return view('admin.changePass',[
            'pro' => $pro,
            'user' => $user
        ]);
    }
    public function updatePass($id,Request $request){
        $validator = Validator::make($request->all(),[
            'current_password' =>'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user =User::find($id);
        if(Hash::make($request->current_password == $user->password)){
            $user->password = $request->password;
            $user->save();
            return redirect()->route('admin.dashboard')->with('success','Password updated successfully');
        }
        else{
            return redirect()->back()->with('error','Passwords not match');
        }
    }
    public function seeComment($id){
        $pro =Project::all();
        $project = Project::find($id);
        $comment = Comment::Select('*')->orderBy('created_at','desc')->where('project_id',$id)->get();
        $comment = Comment::all();
        return view('admin.seeComment',[
            'project'=> $project,
            'comment'=> $comment,
            'pro'=> $pro
        ]);
    }
    public function deleteComment($id){
        $comment =Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success','Comment delted successfully');
    }
    public function totalUsers(){
        $pro =Project::all();
        $user = User::select("id","name","email","profile_pic","created_at")->orderBy("created_at","desc")->where('usertype','!=','admin')->paginate('5');
        return view('admin.totalUsers',[
            'user'=> $user,
            'pro'=> $pro
        ]);
    }
    public function deleteUser($id){
        $user = User::find($id);
        File::delete(public_path('/uploads/profile/'.$user->image));
        File::delete(public_path('/uploads/profile/thumb'.$user->image));
        $user->delete();
        return redirect()->back()->with("success","User deleted successfully");
    }
}
