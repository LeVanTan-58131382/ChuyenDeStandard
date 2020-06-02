<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsageNormInvestors;

class PriceRegulation extends Model
{
    public $table = 'price_regulations';

    protected $fillable = [
        'name',
        'living_expenses_type_id',
        'month_start_of_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function usage_norm_investors() {
        return $this->hasMany(UsageNormInvestors::class, 'price_regulation_id');
    }
}