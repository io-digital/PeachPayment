<?php

namespace IoDigital\PeachPayment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentEvent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'action',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
