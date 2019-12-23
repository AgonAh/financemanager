<?php
namespace App\Http\Controllers;

use App\Invoice;
use App\Project;
use App\User;
use App\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = User::find(Auth::user()['id'])->with('project')->first();
        $data['projects'] = $user['project'];

        return view('/user/index',$data);
    }

    public function history(){
        $invoices = Invoice::where('user_id',1)->with('project')->get();
        $data['invoices']=$invoices;
        return view('/user/history',$data);
    }

    public function projects(){
       // $data['projects'] = Project::with('user')->where('users.id',1)->get();
        $user = User::find(1);
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

    public function newProject(){
        return view(('user/projectCreate'));
    }

//    public function projects(){
//        // $data['projects'] = Project::with('user')->where('users.id',1)->get();
//        $user = User::find(1);
//        $data['projects'] = $user->project()->get();
//        for($i = 0;$i<sizeof($data['projects']);$i++){
//            $project = $data['projects'][$i];
//            $total=0;
//            foreach($project['invoices'] as $invoice){
//                $total+=$invoice['ammount'];
//            }
//            $data['projects'][$index]['total']=$total;
//        }
//        return view('user/projects',$data);
//    }



    //----------PAGES---------------------

    public function createInvoice(Request $request){

        $invoice = new Invoice();
        $invoice->user_id = Auth::user()['id'];
        $invoice->name = $request->input('name');
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
            \Session::flash('success','Invoice sent successfully');
        }
        else{
            \Session::flash('failed','Invoice couldnt be sent');
        }
        return redirect('/');
    }

    public function project(){
        return view('/user/project');
    }

}
