<?php

namespace IoDigital\PeachPayment\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand',
        'last_four',
        'expiry_month',
        'expiry_year',
        'payment_remote_id',
        'registration_id',
        'default',
        'holder',
        'expires_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notExpired', function (Builder $builder) {
            $builder->where('expires_at', '>', now());
        });

        static::creating(function (PaymentCard $payment) {
            $payment->expires_at = Carbon::create($payment->expiry_year, $payment->expiry_month)->startOfMonth();
        });
    }

    public function scopeDefault($query)
    {
        return $query->where('default', true);
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function results()
    {
        return $this->hasMany(PaymentResult::class)->latest();
    }

    public function saveResult($results, $owner)
    {        
        $result = $this->results()->create([
            'transaction_id' => $results['merchantTransactionId'] ?? null,
            'registration_id' => $results['id'] ?? null,
            'payment_type' => $results['paymentType'] ?? null,
            'amount' => isset($results['amount']) ? ($results['amount'] * 100) : null,
            'currency' => $results['currency'] ?? 'ZAR',
            'description' => $results['descriptor'] ?? null,
            'result_code'        => $results['result']['code'] ?? null,
            'result_description' => $results['result']['description'] ?? null,
            'risk_score'  => isset($results['risk']['score']) ? $results['risk']['score'] : null,
            'ndc' => $results['ndc'] ?? null,
        ]);

        $result->owner()->associate($owner);
        $result->save();

        return $result;
    }

    public static function create(array $attributes = [])
    {
        $result = $attributes['result'];

        $formattedAttrs = [
            'brand' => $result['paymentBrand'],
            'last_four' => $result['card']['last4Digits'],
            'holder' => $result['card']['holder'],
            'expiry_month' => $result['card']['expiryMonth'],
            'expiry_year' => $result['card']['expiryYear'],
            'registration_id' => $result['registrationId'] ?? $result['id'],
        ];

        $model = static::query()->create($formattedAttrs);

        if(isset($attributes['owner'])){
            $model->owner()->associate($attributes['owner']);
        }

        $model->save();
        
        return $model;
    }
}
