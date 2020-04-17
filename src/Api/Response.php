<?php

namespace IoDigital\PeachPayment\Api;

use IoDigital\PeachPayment\Models\PaymentCard;

/**
 * Class Response
 *
 * @package IoDigital\PeachPayment\Api
 */
class Response extends ResponseCheck
{
    /**
     * Determine whether an error is due to validation bugs.
     *
     * @param string $code
     *
     * @return bool
     */
    public function isValidationError(string $code): bool
    {
        if ($this->isRejectedAmountValidation($code) ||
            $this->isAccountValidationError($code) ||
            $this->isRejectedReferenceValidation($code) ||
            $this->isRejectedRegistrationValidation($code) ||
            $this->isRejectedTransactionByRiskValidation($code) ||
            $this->isRejectedTransactionByValidation($code) ||
            $this->isRejectedFormatValidation($code)
        ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the transaction was successful.
     *
     * @param string $code
     *
     * @return bool
     */
    public function isSuccessfulResponse(string $code): bool
    {
        if ($this->isSuccessful($code) ||
            $this->isSuccessfulWithReview($code) ||
            $this->isPendingTransaction($code)
        ) {
            return true;
        }

        if ($this->isRejectedExternalTransaction($code) ||
            $this->isRejected3DSecureTransactionCheck($code) ||
            $this->isRejected3DSecureTransaction($code) ||
            $this->isRejectedTransactionByRisk($code) ||
            $this->isRejectedTransactionByRiskValidation($code) ||
            $this->isRejectedTransactionByValidation($code) ||
            $this->isRejectedRegistrationValidation($code) ||
            $this->isRejectedReferenceValidation($code) ||
            $this->isRejectedAmountValidation($code) ||
            $this->isRejectedRiskManagement($code) ||
            $this->isCommunicationError($code) ||
            $this->isSystemError($code) ||
            $this->isAccountValidationError($code) ||
            $this->isBlacklistedError($code)
        ) {
            return false;
        }

        return false;
    }

    /**
     * Save the Peach Payment API call result.
     *
     * @param $paymentCard
     * @param $response
     * @return bool
     */
    public function save($response, PaymentCard $paymentCard)
    {
        $paymentCard->results()->create([
            'transaction_id' => $response['id'],
            'registration_id' => $response['registrationId'] ?? null,
            'payment_type' => $response['paymentType'] ?? null,
            'amount' => $response['amount'] ?? null,
            'currency' => $response['currency'] ?? null,
            'description' => $response['descriptor'] ?? null,
            'result_code' => $response['result']['code'],
            'result_description' => $response['result']['description'],
            'risk_score' => $response['risk']['score'] ?? null,
            'ndc' => $response['ndc'],
        ]);

        return true;
    }
}
