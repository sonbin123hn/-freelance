<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
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
            'total' => $this->resource->total(),
            'per_page' => (int)$this->resource->perPage(),
            'current_page' => $this->resource->currentPage(),
            'last_page' => $this->resource->lastPage(),
            'next' => $this->resource->nextPageUrl() ? $this->resource->currentPage() + 1 : null,
            'prev' => $this->resource->previousPageUrl() ? $this->resource->currentPage() - 1 : null,
          ];
    }
}
