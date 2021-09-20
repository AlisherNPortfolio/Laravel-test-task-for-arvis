<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureItem extends Model
{
    use HasFactory;

    protected $fillable = ['measure_id', 'name', 'price'];

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
