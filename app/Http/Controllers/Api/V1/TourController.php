<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursListRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;

class TourController extends Controller
{
    public function index(Travel $travel , ToursListRequest $request)
    {

        $tours= $travel->tours()
            ->filter($request->query())
            ->orderBy('starting_date')
            ->paginate();
        return TourResource::collection($tours);
    }
}
