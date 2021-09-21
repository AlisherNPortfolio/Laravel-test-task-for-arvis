<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureItem extends Model
{
    use HasFactory;

    protected $fillable = ['measure_id', 'product_id', 'quantity', 'price'];

    protected $hidden = ['updated_at'];

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
