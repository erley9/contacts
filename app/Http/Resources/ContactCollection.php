<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this);

        return [
            'data' => $this->collection,
            'status' => "true",
            "message" => 'Successfully'
        ];
    }

    public function paginationInformation($request, $paginated, $default)
    {
        $default['links']['fronturl'] = 'http://localhost:9200/contact';
        $default['links']['backurl'] = 'http://localhost:8000/contact';
        
        return $default;
    }
}
