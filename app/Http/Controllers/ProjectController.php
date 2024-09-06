<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File as FacadesFile;

class ProjectController extends Controller
{
    public function uploadproject($id){
        $project = Project::find($id);
        $view = Project::all();
        return view('user.uploadproject',[
            'view'=> $view,
        ]);
    }
    public function processUploading(Request $request){
        $rules=[
            'project_name'=>'required',
        ];
        if(!empty($request->file)){
            $rules['file'] = 'file';
        }
        if(!empty($request->file)){
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(),$rules);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $project =new Project();
    $project->name = $request->project_name;
    $project->user_id=$request->user_id;
    $project->profile_id=$request->profile_id;
    $project->save();
    if(!empty($request->image)){
        $image=$request->image;
        $ext=$image->getClientOriginalExtension();
        $imageName=time().'.'.$ext;
        $image->move(public_path('uploads/projects/'),$imageName);
        $project->image = $imageName;
        $project->save();


        $manager = new ImageManager(Driver::class);
        $img = $manager->read(public_path('uploads/projects/'.$imageName));
        $img->cover(200, 200);
        $img->save(public_path('uploads/projects/thumb/'.$imageName));
    }
    if(!empty($request->file)){
    $file=$request->file;
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('uploads/files/'),$filename);
    $project->file = $filename;
    $project->save();
    
        }
    return redirect()->route('user.viewprojects',$request->profile_id)->with('success','Project uploaded successfully');
    }
    public function viewprojects($id ,Request $request){
        $search=$request->search;
        $project = Project::find($id);
        $project = Project::where('name','LIKE','%'.$search.'%')->orderBy('created_at','DESC')->where('user_id',Auth::user()->id);
        $project=$project->paginate('3');
        $proj =Project::where('user_id',Auth::user()->id)->count();
        $projectCount =$proj >0;
        return view('user.viewsProjects',[
            'project'=> $project,
            'projectCount'=> $projectCount,
            'proj' => $proj,
            'search'=> $search,

        ]);
    }
    public function allProjects($id ,Request $request){
        $search=$request->search;
        $project = Project::find($id);
        $project = Project::where('name','LIKE','%'.$search.'%')->orderBy('created_at','DESC');
        $project =$project->paginate('1');
        $proj=$project->count();
        $projcount = $proj>0;
        return view('user.allProjects',[
            'project'=> $project,
            'search'=> $search,
            'proj'=> $proj,
            'projcount'=> $projcount,

        ]);
    }
    public function printPDF($id){
        $project = Project::find($id);
        $pdf = Pdf::loadView('user.invoice',[
            'project'=> $project,
        ]);
        return $pdf->download('invoice.pdf');
    }
    public function editProject($id){
        $project = Project::find($id);
        return view('user.editproject',
    [
        'project'=> $project
    ]);
    }
    public function processEdit($id, Request $request){
      
        $rules=[
            'project_name'=>'required',
        ];
        if(!empty($request->file)){
            $rules['file'] = 'file';
        }
        if(!empty($request->file)){
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(),$rules);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $project = Project::find($id);
    $project->name = $request->project_name;
    $project->user_id=$request->user_id;
    $project->profile_id=$request->profile_id;
    $project->save();
    if(!empty($request->image)){
        FacadesFile::delete(public_path('uploads/projects/'.$project->image));
        FacadesFile::delete(public_path('uploads/projects/thumb/'.$project->image));
        $image=$request->image;
        $ext=$image->getClientOriginalExtension();
        $imageName=time().'.'.$ext;
        $image->move(public_path('uploads/projects/'),$imageName);
        $project->image = $imageName;
        $project->save();


        $manager = new ImageManager(Driver::class);
        $img = $manager->read(public_path('uploads/projects/'.$imageName));
        $img->cover(200, 200);
        $img->save(public_path('uploads/projects/thumb/'.$imageName));
    }
    if(!empty($request->file)){
    FacadesFile::delete(public_path('uploads/files/'.$project->file));
    $file=$request->file;
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('uploads/files/'),$filename);
    $project->file = $filename;
    $project->save();
    
        }
    return redirect()->route('user.viewprojects',$request->profile_id)->with('success','Project edited successfully');
    }
    public function deleteProject($id){
        $project = Project::find($id);
        $project->delete();
        return redirect()->back()->with('success','Project deleted successfully');

    }
    public function home(Request $request){
        $project =Project::Select('*')->where('name','LIKE','%'.$request->search.'%')->orderBy('created_at','desc');
        $project =$project ->paginate('1');
        $proj = $project->count();
        $projcount= $proj;
        return view('welcome',[
            'project' => $project,
            'proj' => $proj,
            'projcount'=> $projcount
        ]);
    }
}
