<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\PaginateResource;
use Symfony\Component\HttpFoundation\Response as HTTPStatus;


class CollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function toResponse($request)
    {
        return JsonResource::toResponse($request);
    }

    // Add pagination format of collection
    public function with($request)
    {
        return [
            'message' => 'Success',
            'status' => HTTPStatus::HTTP_OK,
            'paginate' => new PaginateResource($this)
        ];
    }

}
