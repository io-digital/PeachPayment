<?php

namespace IoDigital\PeachPayment\Api;

use IoDigital\PeachPayment\Traits\ResponseCodes;

/**
 * Class ResponseCheck
 *
 * Provides base functions to determine transaction results
 *
 * @package IoDigital\PeachPayment\Api
 */
class ResponseCheck
{
    use ResponseCodes;

    protected function isSuccessful(string $code): bool
    {
        return array_key_exists($code, self::$success);
    }

    protected function isSuccessfulWithReview(string $code): bool
    {
        return array_key_exists($code, self::$successReview);
    }

    protected function isPendingTransaction(string $code): bool
    {
        return array_key_exists($code, self::$pendingTransaction);
    }

    protected function isRejectedExternalTransaction(string $code): bool
    {
        return array_key_exists($code, self::$rejectedExternalTransaction);
    }

    protected function isRejected3DSecureTransactionCheck(string $code): bool
    {
        return array_key_exists($code, self::$rejectedTransaction3DSecureCheck);
    }

    protected function isRejected3DSecureTransaction(string $code): bool
    {
        return array_key_exists($code, self::$rejectedTransaction3DSecure);
    }

    protected function isRejectedTransactionByRisk(string $code): bool
    {
        return array_key_exists($code, self::$rejectedTransactionByRisk);
    }

    protected function isRejectedTransactionByRiskValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedTransactionByRiskValidation);
    }

    protected function isRejectedTransactionByValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedValidationErrors);
    }

    protected function isRejectedRegistrationValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedRegistrationValidation);
    }

    protected function isRejectedReferenceValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedReferenceValidation);
    }

    protected function isRejectedAmountValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedAmountValidation);
    }

    protected function isRejectedFormatValidation(string $code): bool
    {
        return array_key_exists($code, self::$rejectedFormatValidation);
    }

    protected function isRejectedRiskManagement(string $code): bool
    {
        return array_key_exists($code, self::$rejectedRiskManagement);
    }

    protected function isCommunicationError(string $code): bool
    {
        return array_key_exists($code, self::$rejectedCommunication);
    }

    protected function isSystemError(string $code): bool
    {
        return array_key_exists($code, self::$systemErrors);
    }

    protected function isAccountValidationError(string $code): bool
    {
        return array_key_exists($code, self::$accountErrors);
    }

    protected function isBlacklistedError(string $code): bool
    {
        return array_key_exists($code, self::$blacklistErrors);
    }
}
