<?php
namespace App\Http\Controllers;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        //TODO::Add admin role to db and check it here
    }

    public function index(){
        $data['newinvoices']=Invoice::where('approved',0)->count();
        $data['approvedinvoices']=Invoice::where('approved',1)->count();
        $data['urgentinvoices']=Invoice::where('due_date','<',date("Y-m-d H:i:s", time()+259200))->where('approved','=',0)->count();
        //SELECT * FROM `invoices` WHERE month(due_date) = month(CURRENT_DATE) and year(due_date) = year(CURRENT_DATE)
        return view('admin/index',$data);
    }

    public function newInvoices(){
        $data['invoices'] = $this->getInvoices(0);
        return view('/admin/newInvoices',$data);
    }

    public function approvedInvoices(){
        $data['invoices'] = $this->getInvoices(1);
        return view('admin/approvedInvoices',$data);
    }

    public function urgentInvoices(){
        $data['invoices'] = Invoice::where('due_date','<',date("Y-m-d H:i:s", time()+259200))->where('approved','=',0)->latest()->get();
        return view('admin/urgentInvoices',$data);
    }

    public function loadInvoicesApi($id){
        $data['invoices'] = Invoice::whereRaw('month(due_date)=?',[$id])->get();
        return view('/admin/loadInvoicesApi',$data);
    }

    public function approveInvoice(Request $request){
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
        return Invoice::where('approved',$type)->get();
    }

}

?>
