<?php

namespace App\Http\Resources\Loan;

use App\Http\Resources\CollectionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanContractCollection extends CollectionResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $collects = LoanContractResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
