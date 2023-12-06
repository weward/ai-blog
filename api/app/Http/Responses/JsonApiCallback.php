<?php

namespace App\Http\Responses;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class JsonApiCallback
{

    /**
     * @param Collection|Model|LengthAwarePaginator|null  $data
     * @param int  $httpStatus
     * @param string  $model Specific resource to use
     */
    public function __invoke($data, $httpStatus = 500): JsonResponse
    {
         return ($data instanceof JsonResource || $data instanceof ResourceCollection)
            ? $data->response()->setStatusCode($httpStatus)
            : response()->json($data ?? 'Oops! Something went wrong.', $httpStatus);
    }

}
