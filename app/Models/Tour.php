<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tour extends Model
{
    use HasFactory,HasUuids;
    protected $fillable = ['name','travel_id', 'starting_date', 'ending_date', 'price'];
    public function price():Attribute
    {
        return Attribute::make(
            get: fn ($value,$attribute) => $value / 100,
            set: fn ($value,$attribute) => $value * 100,
        );
    }
    public function scopeFilter(Builder $builder ,$filters){
        $builder->when($filters['priceFrom'] ?? null,fn($query,$priceFrom)=>$query->where('price','>=',$priceFrom*100));
        $builder->when($filters['priceTo'] ?? null,fn($query,$priceTo)=>$query->where('price','<=',$priceTo*100));
        $builder->when($filters['dateFrom'] ?? null,fn($query,$dateFrom)=>$query->where('starting_date','>=',$dateFrom));
        $builder->when($filters['dateTo'] ?? null,fn($query,$dateTo)=>$query->where('starting_date','<=',$dateTo));
        $builder->when($filters['sortBy'] ?? null,fn($query,$sortBy)=>$query->orderBy($sortBy,$filters['sortOrder'] ?? 'asc'));
        $builder->when($filters['sortOrder'] ?? null,fn($query,$sortOrder)=>$query->orderBy($filters['sortBy'] ?? 'ending_date',$sortOrder));
    }
}
