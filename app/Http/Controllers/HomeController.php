<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoanContractRequest;
use App\Models\Employee;
use App\Models\Loan_contract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $newMember = User::whereDate('created_at', '=', $date)->count();
        $allMember = User::all()->count();
        return view('admin/dashboard',compact('newMember','allMember'));
    }

    //employee 
    public function employees()
    {
        $employees = Employee::paginate(10);
        return view("admin/employee/index",compact('employees'));
    }   

    public function create()
    {
        return view("admin/employee/add");
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
        if(Employee::create($data)){
             return redirect('/admin/employee')->with('success','employee successfully created');
        }
        return back()->with('error','employee create failed'); 

    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view("admin/employee/edit",compact('employee'));
    }

   
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->all();
      
        if($employee->update($data)){
            return redirect('/admin/employee')->with('success','employee Update is success');
        }
        return back()->with('error','employee Update failed'); 
    }
    
    public function lock($id)
    {
        $data = Employee::findOrFail($id);
        if($data['active'] == 2){
            $data['active'] = 1;
            if($data->update()){
                return redirect('/admin/employee')->with('success','unlock is success');
            }
        }
        $data['active'] = 2;
        if($data->update()){
            return redirect('/admin/employee')->with('success','lock is success');
        };
    }

    //user
    public function users()
    {
        $users = User::paginate(10);
        return view("admin/user/index",compact('users'));
    }

    //loan contracts
    public function contracts()
    {
        $contracts = Loan_contract::paginate(10);
        return view("admin/contracts/index",compact('contracts'));
    }

    public function editContract($id)
    {
        $contracts = Loan_contract::findOrFail($id);
        return view("admin/contracts/edit",compact('contracts'));
    }

    public function updateContract(LoanContractRequest $request, $id)
    {
        $contracts = Loan_contract::findOrFail($id);
        $data = $request->all();
      
        if($contracts->update($data)){
            return redirect('/admin/contracts')->with('success','contracts Update is success');
        }
        return back()->with('error','contracts Update failed'); 
    }

    //duyệt hồ sơ xác minh user or duyệt hợp đồng
    public function confirm($id)
    {
        $user = User::findOrFail($id);
        if($user->active == 0){
            $user->active = 1;
            $user->save();
        }elseif($user->active == 1){
            $user->active = 2;
            $user->save();
        }
        // trả về trang chi tiết
        return redirect("/admin/users/".$id."")->with('success','confirm is success');
    }

    public function confirmWithDrawal($id)
    {
        $user = User::findOrFail($id);
        $user->withDrawalType = $user->withDrawalType == 0 ? 1 : 0;
        $user->save();
       
        // trả về trang chi tiết
        return redirect("/admin/users/".$id."")->with('success','confirm is success');
    }
    
}
