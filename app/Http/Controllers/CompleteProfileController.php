<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompleteProfileController extends Controller
{
public function completeProfile($id){
    $user = User::find($id);
    $profile = Profile::where("user_id", $user->id)->count();
    $countcomp = $profile > 0;
    return view("user.completeProfile",[
        "user"=> $user,
        "countcomp"=> $countcomp,
        "profile"=> $profile
    ]);
}
public function processCompleteProfile($id, Request $request){
    $rules=[
        'name'=> 'required',
        'country'=>'required',
        'address'=>'required',
        'about'=>'required',
        'skills'=> 'required',
        'contact'=>'required',
        'experience'=>'required'
    ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->skills = $request->skills;
        $user->contact = $request->contact;
        $user->experience = $request->experience;
        $user->user_id =$request->user_id;
        return redirect()->route('user.dashboard')->with('success','You have completed your profile successfully');
}
    public function editProfile($id){
        $profile = Profile::find($id);
        return view('user.editProfile',[
            'profile'=> $profile
        ]);
    }
        public function processEditProfile($id, Request $request){
            $rules=[
                'name'=> 'required',
                'country'=>'required',
                'address'=>'required',
                'about'=>'required',
                'skills'=> 'required',
                'contact'=>'required',
                'experience'=>'required'
            ];
                $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user = User::find($id);
                $user->name = $request->name;
                $user->country = $request->country;
                $user->address = $request->address;
                $user->about = $request->about;
                $user->skills = $request->skills;
                $user->contact = $request->contact;
                $user->experience = $request->experience;
                $user->user_id =$request->user_id;
                return redirect()->route('user.dashboard')->with('success','You have completed your profile successfully');
}
            public function changePass($id){
                $user = User::find($id);
                return view('user.changePass');
            }
            public function processChangePass($id,Request $request){
                $rules=[
                    'current_password' =>'required',
                    'password' =>'required|confirmed',
                    'password_confirmation' => 'required'
                ];
                $validator =Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user = User::find($id);
                if(Hash::make($request->current_password)==$request->password && $request->password_confirmation){
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return redirect()->route('user.dashboard')->with('success','Your password has been successfully changed');
                }
            }
            public function otherProfile($id){
                $user =Profile::find($id);
                $user = User::all()->where('id',$id);
                $profile = Profile::where('user_id',$id)->get();
                $profile = Profile::where('user_id',$id)->count();
                $pro =Profile::all();
                $profileCount= $profile > 0;
                return view('user.otherProfile',[
                    'profile'=> $profile,
                    'user'=>$user,
                    'profileCount'=> $profileCount,
                    'pro' =>$pro
                ]);
            }
    }