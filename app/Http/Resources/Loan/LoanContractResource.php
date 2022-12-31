<?php

namespace App\Http\Resources\Loan;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            "loanValue"     => $this->loanValue,
            "loanTime"      => $this->loanTime,
            "signature"     => $this->signature,
            "prive"         => $this->prive,
            "userId"        => $this->userId,
            "status"        => $this->status,
            'created_at'    => $this->createdAt,
            'updated_at'    => $this->updated_at
        ];
    }
}
