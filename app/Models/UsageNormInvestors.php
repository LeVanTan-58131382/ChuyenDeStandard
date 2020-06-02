<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PriceRegulation;

class UsageNormInvestors extends Model
{
    public $table = 'usage_norm_investors';

    protected $fillable = [
        'price_regulation_id',
        'name',
        'level',
        'living_expenses_type_id',
        'usage_index_from',
        'usage_index_to',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function price_regulations() // tên table
    {
        return $this->belongsTo(PriceRegulation::class);
    }
}