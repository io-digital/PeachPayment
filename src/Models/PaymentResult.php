<?php

namespace IoDigital\PeachPayment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Stores the results from API calls made to Peach Payments.
 *
 * Class PaymentResult
 * @package App\Models
 */
class PaymentResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'owner_type',
        'owner_id',
        'transaction_id',
        'registration_id',
        'payment_type',
        'amount',
        'currency',
        'description',
        'result_code',
        'result_description',
        'risk_score',
        'ndc',
    ];

    public function owner()
    {
        return $this->morphTo();
    }

    public function card()
    {
        return $this->belongsTo(PaymentCard::class, 'payment_card_id');
    }
}
