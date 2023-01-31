<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoanContractRequest;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Loan_contract;
use App\Models\User;
use App\Models\UserEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $userNotActive = User::where('active',0)->count();
        $userActive = User::where('active',1)->count();
        $userActiveContract = User::where('active',2)->count();

        $allMember = User::all()->count();
        $range = Carbon::now()->subDays(30);
        $stats = User::where('created_at', '>=', $range)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get([
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as value')
        ])->toJSON();
        
        return view('admin/dashboard',compact('newMember','allMember','stats','userActiveContract','userActive','userNotActive'));
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
             return redirect('/admin/employee')->with('success','Thêm nhân viên thành công');
        }
        return back()->with('error','Thêm nhân viên thất bại'); 

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
            return redirect('/admin/employee')->with('success','Cập nhật nhân viên thành công');
        }
        return back()->with('error','cập nhật nhân viên thất bại'); 
    }
    
    public function lock($id)
    {
        $data = Employee::findOrFail($id);
        if($data['active'] == 2){
            $data['active'] = 1;
            if($data->update()){
                return redirect('/admin/employee')->with('success','Mở khóa thành công');
            }
        }
        $data['active'] = 2;
        if($data->update()){
            return redirect('/admin/employee')->with('success','Khóa thành công');
        };
    }

    public function deleteEmployee($id)
    {
        $data = Employee::findOrFail($id);
        UserEmployee::where('employeeId',$id)->delete();
        if($data->delete()){
            return redirect('/admin/employee')->with('success','Xóa nhân viên thành công');
        }
        return redirect('/admin/employee')->with('error','Xóa không thành công');
    }

    //user
    public function users()
    {
        if(session()->has('active')) {
            $active = session()->get('active');
            $users = User::where('active',$active)->paginate(10);
            session()->forget('active');
        }else{
            $users = User::paginate(10);
        }
        return view("admin/user/index",compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        if(empty($user)){
            return redirect('admin/users')->with('error','Không tìm thấy khách hàng');
        }
        
        return view("admin/user/edit",compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if($user->delete()){
            return redirect('admin/users')->with('success','Xóa khách hàng thành công');
        }
        return back()->with('error','Xóa khách hàng thất bại');
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
    
    public function changePass(ChangePassRequest $request)
    {
        $user = Admin::findOrFail(auth()->user()->id);
        if (Hash::check($request->password_old,$user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success','cập nhật mật khẩu thành công');
        }
        return back()->with('error','mật khẩu cũ không đúng'); 
    }
    
    public function ajaxActive($active)
    {
        session()->put('active', $active);
        echo $active;
    }
}
