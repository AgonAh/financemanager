<?php
namespace App\Http\Controllers;

use App\Invoice;
use App\Project;
use App\User;
use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }


    private function checkUser(){
        if(Auth::user()->role_id>1){
            session()->flash('failed','Nuk keni akses useri');
            return redirect('/admin');
        }
        else return false;
    }

    public function editProfile(){
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        return view('/user/profile',$data);
    }

    public function updateProfile(Request $request){
        $validated = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
            'password'=>'nullable|min:8|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name=$request->post('name');
        $user->email=$request->post('email');
        if($request->post('password')!=''){
            $user->password=Hash::make($request->post('password'));
        }
        if($user->save())
            return \redirect('/profile')->with('success','Profile successfully updated');
        return \redirect('/profile')->with('failed','Profile couldnt be updated');
    }

//    public function fakturat(){
//        Invoice::where('')
//    }

    public function index(){
        $isUser = $this->checkUser();  if($isUser) return $isUser;
        $user = User::find(Auth::user()->id);
        $data['projects'] = $user->project()->get();
        $data['js']="document.getElementById('invoiceLi').classList.add('active')";

        return view('/user/index',$data);
    }

    public function history(){
        $data['js']="document.getElementById('historyLi').classList.add('active')";

        $isUser = $this->checkUser();  if($isUser) return $isUser;
        $invoices = Invoice::where('user_id',Auth::user()->id)->with('project')->get();
        $data['invoices']=$invoices;
        return view('/user/history',$data);
    }

    public function projects(){
        $data['js']="document.getElementById('projectLi').classList.add('active')";
        $isUser = $this->checkUser();  if($isUser) return $isUser;
        // $data['projects'] = Project::with('user')->where('users.id',1)->get();
        $user = User::find(Auth::user()->id);
        $data['projects'] = $user->project()->get();
        foreach($data['projects'] as $index=>$project){
            $total=0;
            foreach($project['invoice'] as $invoice){
                $total+=$invoice['ammount'];
            }
            $data['projects'][$index]['total']=$total;
        }
        return view('user/projects',$data);
    }

    public function viewProject($id){
        $project = Project::find($id);
        $users = $project->user()->get();
         $this->inProject(Auth::user()->id,$users);
        if(!($this->inProject(Auth::user()->id,$users) || Auth::user()->role_id>1)){ //Only allow if user is admin or member of the project
            return back()->with('failed','You are not in this project');
        }
        $data['project'] = $project;
        $data['users'] = $users;
        return view('user/project',$data);
    }




    public function projectCreate(Request $request){
        $isUser = $this->checkUser();  if($isUser) return $isUser;
        $project = new Project;
        $project['name'] = $request->post('name');
        $project->save();
        $project->user()->attach(Auth::user()->id);
        session()->flash('success','Project created successfully');
        return redirect('/');
    }



    //----------PAGES---------------------

    public function createInvoice(Request $request){
//        print_r($request->post());
//        return;
        $isUser = $this->checkUser();  if($isUser) return $isUser;
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()['id'];
        $invoice->name = $request->input('description');
//        $invoice->name = $request->input('name');
        $invoice->ammount =$request->input('ammount');
        $invoice->due_date =$request->input('due_date');
        $invoice->payment_type_id = $request->input('payment_type');
        $invoice->description = $request->input('description');
        $invoice->project_id = $request->input('project_id')!='NULL' ?  $request->input('project_id') : NULL;
        if($request->file('document')){
            $path = $request->file('document')->store('documents');
            $invoice->document = $path;
        }
        if($invoice->save()){
            \Session::flash('success','Faktura u dergua me sukses');
        }
        else{
            \Session::flash('failed','Faktura nuk u dergua');
        }
        return redirect('/');
    }

    public function project(){
        $isUser = $this->checkUser();  if($isUser) return $isUser;
        return view('/user/project');
    }

    public function inProject($id, $users){
        foreach ($users as $user){
            if($user['id']==$id)
                return true;
        }
        return false;
    }

}
