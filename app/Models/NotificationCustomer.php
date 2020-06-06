<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationCustomer extends Model
{
    public $table = 'customer_notification';

    protected $fillable = [
        'customer_id',
        'notification_id',
        'read',
        'deleted',
        'bill_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
