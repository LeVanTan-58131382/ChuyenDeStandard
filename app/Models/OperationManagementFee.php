<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationManagementFee extends Model
{
    public $table = 'operation_management_fees';

    protected $fillable = [
        'name',
        'price_regulation_id',
        'price',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
