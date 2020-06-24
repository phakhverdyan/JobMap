<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseCollectionResource extends ResourceCollection
{
    public function __construct($resource) {
        if ($resource instanceof LengthAwarePaginator) {
            $this->additional([
                'pagination' => ($resource->total() > 0 ? [
                    'current_page'  => $resource->currentPage(),
                    'last_page'     => $resource->lastPage(),
                    'per_page'      => $resource->perPage(),
                    'count'         => $resource->count(),
                    'total'         => $resource->total(),
                ] : null),
            ]);

            parent::__construct($resource->getCollection());
            return;
        }

        parent::__construct($resource);
    }
    
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
