<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\CreateLoanRequest;
use App\Http\Requests\User\EKYCRequest;
use App\Http\Resources\Loan\LoanContractCollection;
use App\Models\Loan_contract;
use App\Models\User;
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
        $data['prive'] = random_int(1,999999999);
        $file = $request->signature;
        $data['signature'] = $this->uploadImage("signature",$file);

        $loanContract = Loan_contract::create($data);
        if($loanContract){
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

        $idFront = $request->idFront;
        $idBack = $request->idBack;
        $face = $request->face;
        
        $data['idFront'] = $this->uploadImage("user".$user->userName ?? $user->phoneNumber."",$idFront);
        $data['idBack'] = $this->uploadImage("user".$user->userName ?? $user->phoneNumber."",$idBack);
        $data['face'] = $this->uploadImage("user".$user->userName ?? $user->phoneNumber."",$face);

        if($user->update($data)){
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
            $filename = $date.'_'.$random.'-'.$name;
            while (file_exists('/uploads/'.$code.'/'.$filename)) {
                $filename = $date.'_'.$random.'-'.$name;
            }

            $folderpath = public_path('/uploads/'.$code.'/');
            File::makeDirectory($folderpath, $mode = 0777, true, true);
            $file->move($folderpath, $filename);
            $imageUrl = '/uploads/'.$code.'/'.rawurlencode($filename);
            return $imageUrl;
        } catch (Exception $exception) {
            abort(402, 'Upload fails.');
        }
    }
}
