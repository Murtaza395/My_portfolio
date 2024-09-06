<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function postComment(Request $request,$id){
        $validator =Validator::make($request->all(),[
            'comment'=>'required|min:10',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $comment = Comment::find($id);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id= $request->user_id;
        $comment->profile_id= $request->profile_id;
        $comment->project_id= $request->project_id;
        $comment->save();
        return redirect()->back()->with('success','Comment Posted Successfully');
    }
    public function seeComment($id){
        $project = Comment::find($id);
        $proj=Project::all();
        $comment = Comment::Select('*')->orderBy('created_at','desc')->where('project_id',$id)->get();
        $cmt =Comment::orderBy('created_at','desc')->where('project_id',$id)
        ->where('user_id','!=',Auth::id())->count();
        return view('user.seeComment',[
            'project'=> $project,
            'comment'=> $comment,
            'cmt'=> $cmt,
            'proj'=>$proj
        ]);
    }
    public function deleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success','Comment deleted Successfully');
    }
}
