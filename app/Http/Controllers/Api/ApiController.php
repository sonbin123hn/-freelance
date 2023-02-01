<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\CreateLoanRequest;
use App\Http\Requests\User\EKYCRequest;
use App\Http\Resources\Loan\LoanContractCollection;
use App\Models\Employee;
use App\Models\History;
use App\Models\Loan_contract;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use File;

class ApiController extends Controller
{
    public function createLoan(CreateLoanRequest $request)
    {
        $data = $request->all();
        $data['userId'] = auth()->user()->id;
        $data['prive'] = random_int(1, 999999999);

        $loanContract = Loan_contract::create($data);
        if ($loanContract) {
            return $this->responseSuccessWithData($loanContract);
        }

        return $this->responseError("Couldn't create");
    }

    public function listLoan()
    {
        $listLoan = auth()->user()->loan;
        return $this->responseSuccessWithData($listLoan);
    }

    public function ekyc(EKYCRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->only(
            "idFront",
            "idBack",
            "face",
            "userName",
            "cccd",
            "sex",
            "birth",
            "bankUserName",
            "bankAccount",
            "bank",
            "salary",
            "reason",
            "address",
            "job",
            "relationship",
            "phoneNumberRelationship"
        );
        $idFront = $request->idFront;
        $idBack = $request->idBack;
        $face = $request->face;

        $data['idFront'] = $this->uploadImage("user" . $user->userName ?? $user->phoneNumber . "", $idFront);
        $data['idBack'] = $this->uploadImage("user" . $user->userName ?? $user->phoneNumber . "", $idBack);
        $data['face'] = $this->uploadImage("user" . $user->userName ?? $user->phoneNumber . "", $face);
        $data['active'] = 1;

        if ($user->update($data)) {
            return $this->responseSuccessWithData($user);
        }

        return $this->responseError("Couldn't ekyc");
    }


    public static function uploadImage($code, $file, $width = 300, $height = 300)
    {
        try {
            $random = Str::random(8);
            $date = now()->format('Y-m-d');
            $name = $file->getClientOriginalName();
            $filename = $date . '_' . $random . '-' . $name;
            while (file_exists('/uploads/' . $code . '/' . $filename)) {
                $filename = $date . '_' . $random . '-' . $name;
            }

            $folderpath = public_path('/uploads/' . $code . '/');
            File::makeDirectory($folderpath, $mode = 0777, true, true);
            $file->move($folderpath, $filename);
            $imageUrl = '/uploads/' . $code . '/' . rawurlencode($filename);
            return $imageUrl;
        } catch (Exception $exception) {
            abort(402, 'Upload fails.');
        }
    }

    public function cmnd(Request $request)
    {
        $cccd = User::where('cccd', $request->cccd)->first();
        if ($cccd) {
            return $this->responseSuccess("CCCD/CMND đã được sử dụng");
        }
        return $this->responseSuccess("");
    }

    public function employee()
    {
        $userId = auth()->user()->id;
        $employee = Employee::query();
        $userEmployee = UserEmployee::where(['userId' => $userId])->first();

        foreach ($employee->get() as $val) {
            if ($val->active == 0) {
                UserEmployee::where('employeeId', $val->id)->delete();
            }
        }

        if ($employee->where('active', 1)->count() > 0) {
            if (!$userEmployee) {
                $result = $employee->where('active', 1)->get()->random(1)->first();
                UserEmployee::create([
                    "userId" => $userId,
                    "employeeId" => $result->id
                ]);
            }else{
                $result = $employee->where('id', $userEmployee->employeeId)->first();
            }
            return $this->responseSuccessWithData($result);
        }
        return $this->responseSuccessWithData(null);
    }

    public function withdrawal(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if ($user->withDrawalType == 1 && $user->active == 2) {
            $history = History::create([
                'userId' => $user->id,
                'type' => 2,
                'value' => empty($request->value) ? $user->wallet : $request->value
            ]);
            $user->wallet = empty($request->value) ? 0 : $user->wallet - $request->value;
            $user->save();
            $history['wallet'] = $user->wallet;
            $history['note'] = $user->note;
            return $this->responseSuccessWithData($history);
        }
        return $this->responseError("tài khoản chưa được xác minh hoặc bạn không thể rút tiền");
    }

    public function history(Request $request)
    {
        $history = History::where('userId', auth()->user()->id);
        if (!empty($request->type)) {
            $history = $history->where("type", $request->type)
                ->orderBy("created_at", "desc")
                ->first();
        } else {
            $history = $history->get();
        }
        return $this->responseSuccessWithData($history);
    }
}
