<?php
namespace App\Http\Controllers;
use App\Invoice;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');


    }

    private function checkAdmin(){
        if(Auth::user()->role_id<2){
            session()->flash('failed','Nuk keni akses admini');
            return redirect('/');
        }
        return false;
    }

    public function index(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['newinvoices']=Invoice::where('approved',0)->count();
        $data['approvedinvoices']=Invoice::where('approved',1)->count();
        $data['resubmittedInvoices']=Invoice::where('approved',3)->count();
        $data['js']="document.getElementById('adminLi').classList.add('active')";
        $data['urgentinvoices']=Invoice::where('due_date','<',date("Y-m-d H:i:s", time()+259200))->where('approved','=',0)->count();
        //SELECT * FROM `invoices` WHERE month(due_date) = month(CURRENT_DATE) and year(due_date) = year(CURRENT_DATE)
        return view('admin/index',$data);
    }

    public function newInvoices(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['invoices'] = $this->getInvoices(0);
        return view('/admin/newInvoices',$data);
    }

    public function approvedInvoices(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['invoices'] = $this->getInvoices(1);
        return view('admin/approvedInvoices',$data);
    }

    public function resubmittedinvoices(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['invoices'] = $this->getInvoices(3);
        return view('admin/resubmittedinvoices',$data);
    }

    public function urgentInvoices(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['invoices'] = Invoice::where('due_date','<',date("Y-m-d H:i:s", time()+259200))->where('approved','=',0)->latest()->get();
        return view('admin/urgentInvoices',$data);
    }

    public function loadInvoicesApi($id){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
//        $data['invoices'] = Invoice::whereRaw('month(due_date)=?',[$id])->get();
        $data['invoices'] = Invoice::all();
        return view('/admin/loadInvoicesApi',$data);
    }

    public function approveInvoice(Request $request){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $invoiceId = $request->post('invoiceId');
        $invoice = Invoice::where('id',$invoiceId)->first();
        $invoice->approved = 1;
        $invoice->approved_by = Auth::user()['id'];
        $invoice->approved_on=date("Y-m-d H:i:s", time());
        $invoice->save();
        \Session::flash('success','Invoice was approved');
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function declineInvoice(Request $request){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $invoiceId = $request->post('invoiceId');
        $invoice = Invoice::where('id',$invoiceId)->first();
        $invoice->approved = 2;
        $invoice->approved_by = Auth::user()['id'];
        $invoice->approved_on=date("Y-m-d H:i:s", time());
        $invoice->save();
        \Session::flash('failed','Invoice was rejected');
        return redirect($_SERVER['HTTP_REFERER']);
    }


    private function getInvoices($type){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        return Invoice::where('approved',$type)->get();
    }

    public function manageUsers(){
        $isAdmin = $this->checkAdmin(); if($isAdmin) return $isAdmin;
        $data['users']=User::all();
        $data['js']="document.getElementById('manageLi').classList.add('active')";
        return view('admin/manageUsers',$data);
    }

    public function updateUser(Request $request){
//        echo json_encode($request->post());
        $user = User::find($request->post('id'));
        $user->name=$request->post('name');
        $user->email=$request->post('email');
        if($request->post('role_id')!=null){
            if($request->post('role_id')==3 && Auth::user()->role_id!=3){
                session()->flash('failed','Nuk mund te caktosh superadmin pa qene superadmin');
                return back();
            }
            $user->role_id=$request->post('role_id');
        }
        $user->save();
        session()->flash('success','Perdoruesi '.$request->post('name').' u ruajt me sukses');

        return back();
    }

    public function addUser(Request $request){
        $user = new User;
        $user->name=$request->post('name');
        $user->email=$request->post('email');
        $user->password=\Hash::make($request->post('email'));
        $user->role_id=$request->post('role_id');
        $user->save();
        session()->flash('success','Perdoruesi '.$request->post('name').' u krijua me sukses');
        return back();
    }

}

?>
