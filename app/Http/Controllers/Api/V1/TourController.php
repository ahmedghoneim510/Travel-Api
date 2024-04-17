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
//        $request->validate([
//            'priceFrom'=>'numeric|nullable',
//            'priceTo'=>'numeric|nullable',
//            'dateFrom'=>'date',
//            'dateTo'=>'date',
//            'sortBy'=>Rule::in('price'),
//            'sortOrder'=>Rule::in('desc','asc'),
//        ],[
//            'sortBy'=>"The sortBy must be in 'price' value",
//            'sortOrder'=>'The sortOrder must be in "desc" or "asc" value'
//
//        ]);

        $tours= $travel->tours()
            ->filter($request->query())
            ->orderBy('starting_date')
            ->paginate();
        return TourResource::collection($tours);
    }
}
