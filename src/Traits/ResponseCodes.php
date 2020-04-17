<?php

namespace IoDigital\PeachPayment\Traits;

/**
 * Class Response
 *
 * List relevant API responses from Peach Payments.
 *
 */
trait ResponseCodes
{
    /**
     * List successful transaction response codes.
     *
     * @var array
     */
    public static $success = [
        '000.000.000' => 'Transaction succeeded',
        '000.000.100' => 'Successful request',
        '000.100.110' => "Request successfully processed in 'Merchant in Integrator Test Mode'",
        '000.100.111' => "Request successfully processed in 'Merchant in Validator Test Mode'",
        '000.100.112' => "Request successfully processed in 'Merchant in Connector Test Mode'",
        '000.300.000' => 'Two-step transaction succeeded',
        '000.300.100' => 'Risk check successful',
        '000.300.101' => 'Risk bank account check successful',
        '000.300.102' => 'Risk report successful',
        '000.310.100' => 'Account updated',
        '000.310.101' => 'Account updated (Credit card expired)',
        '000.310.110' => 'No updates found, but account is valid',
        '000.600.000' => 'Transaction succeeded due to external update',
    ];

    /**
     * List successful transaction response codes that require manual review.
     *
     * @var array
     */
    public static $successReview = [
        '000.400.000' => 'Transaction succeeded (please review manually due to fraud suspicion)',
        '000.400.010' => 'Transaction succeeded (please review manually due to AVS return code)',
        '000.400.020' => 'Transaction succeeded (please review manually due to CVV return code)',
        '000.400.040' => 'Transaction succeeded (please review manually due to amount mismatch)',
        '000.400.050' => 'Transaction succeeded (please review manually because transaction is pending)',
        '000.400.060' => 'Transaction succeeded (approved at merchant\'s risk)',
        '000.400.070' => 'Transaction succeeded (waiting for external risk review)',
        '000.400.080' => 'Transaction succeeded (please review manually because the service was unavailable)',
        '000.400.090' => 'Transaction succeeded (please review manually due to external risk check)',
        '000.400.100' => 'Transaction succeeded, risk after payment rejected',
    ];

    /**
     * List pending transaction response codes.
     *
     * @var array
     */
    public static $pendingTransaction = [
        '000.200.000' => 'Transaction pending',
        '000.200.100' => 'Successfully created checkout',
        '000.200.101' => 'Successfully updated checkout',
        '000.200.102' => 'Successfully deleted checkout',
        '000.200.200' => 'Transaction initialized',
        '100.400.500' => 'Waiting for external risk',
        '800.400.500' => 'Waiting for confirmation of non-instant payment. Denied for now.',
        '800.400.501' => 'Waiting for confirmation of non-instant debit. Denied for now.',
        '800.400.502' => 'Waiting for confirmation of non-instant refund. Denied for now.',
    ];

    /**
     * List rejected transaction response codes.
     *
     * @var array
     */
    public static $rejectedTransaction3DSecureCheck = [
        '000.400.101' => 'Card not participating/authentication unavailable',
        '000.400.102' => 'User not enrolled',
        '000.400.103' => 'Technical Error in 3D system',
        '000.400.104' => 'Missing or malformed 3DSecure Configuration for Channel',
        '000.400.105' => 'Unsupported User Device - Authentication not possible',
        '000.400.106' => 'Invalid payer authentication response(PARes) in 3DSecure Transaction',
        '000.400.107' => 'Communication Error to VISA/Mastercard Directory Server',
        '000.400.108' => 'Cardholder Not Found - card number provided is not found in the ranges of the issuer',
        '000.400.200' => 'Risk management check communication error',
    ];

    /**
     * Result codes for rejections due to 3Dsecure.
     *
     * @var array
     */
    public static $rejectedTransaction3DSecure = [
        '100.380.401' => 'User Authentication Failed',
        '100.390.101' => 'Purchase amount/currency mismatch',
        '100.390.102' => 'PARes Validation failed',
        '100.390.103' => 'PARes Validation failed - problem with signature',
        '100.390.104' => 'XID mismatch',
        '100.390.105' => 'Transaction rejected because of technical error in 3DSecure system',
        '100.390.106' => 'Transaction rejected because of error in 3DSecure configuration',
        '100.390.107' => 'Transaction rejected because cardholder authentication unavailable',
        '100.390.108' => 'Transaction rejected because merchant not participating in 3DSecure program',
        '100.390.109' => 'Transaction rejected because of VISA status \'U\' or AMEX status \'N\' or \'U\' in 3DSecure program',
        '100.390.110' => 'Cardholder Not Found - card number provided is not found in the ranges of the issuer',
        '100.390.111' => 'Communication Error to VISA/Mastercard Directory Server',
        '100.390.112' => 'Technical Error in 3D system',
        '100.390.113' => 'Unsupported User Device - Authentication not possible',
        '800.400.200' => 'Invalid Payer Authentication in 3DSecure transaction',
    ];

    /**
     * List rejected by external bank transaction response codes.
     *
     * @var array
     */
    public static $rejectedExternalTransaction = [
        '800.100.100' => 'Transaction declined for unknown reason',
        '800.100.150' => 'Transaction declined (refund on gambling tx not allowed)',
        '800.100.151' => 'Transaction declined (invalid card)',
        '800.100.152' => 'Transaction declined by authorization system',
        '800.100.153' => 'Transaction declined (invalid CVV)',
        '800.100.154' => 'Transaction declined (transaction marked as invalid)',
        '800.100.155' => 'Transaction declined (amount exceeds credit)',
        '800.100.156' => 'Transaction declined (format error)',
        '800.100.157' => 'Transaction declined (wrong expiry date)',
        '800.100.158' => 'Transaction declined (suspecting manipulation)',
        '800.100.159' => 'Transaction declined (stolen card)',
        '800.100.160' => 'Transaction declined (card blocked)',
        '800.100.161' => 'Transaction declined (too many invalid tries)',
        '800.100.162' => 'Transaction declined (limit exceeded)',
        '800.100.163' => 'Transaction declined (maximum transaction frequency exceeded)',
        '800.100.164' => 'Transaction declined (merchants limit exceeded)',
        '800.100.165' => 'Transaction declined (card lost)',
        '800.100.166' => 'Transaction declined (Incorrect personal identification number)',
        '800.100.167' => 'Transaction declined (referencing transaction does not match)',
        '800.100.168' => 'Transaction declined (restricted card)',
        '800.100.169' => 'Transaction declined (card type is not processed by the authorization center)',
        '800.100.170' => 'Transaction declined (transaction not permitted)',
        '800.100.171' => 'Transaction declined (pick up card)',
        '800.100.172' => 'Transaction declined (account blocked)',
        '800.100.173' => 'Transaction declined (invalid currency, not processed by authorization center)',
        '800.100.174' => 'Transaction declined (invalid amount)',
        '800.100.175' => 'Transaction declined (invalid brand)',
        '800.100.176' => 'Transaction declined (account temporarily not available. Please try again later)',
        '800.100.177' => 'Transaction declined (amount field should not be empty)',
        '800.100.178' => 'Transaction declined (PIN entered incorrectly too often)',
        '800.100.179' => 'Transaction declined (exceeds withdrawal count limit)',
        '800.100.190' => 'Transaction declined (invalid configuration data)',
        '800.100.191' => 'Transaction declined (transaction in wrong state on aquirer side)',
        '800.100.192' => 'Transaction declined (invalid CVV, Amount has still been reserved on the customer\'s card and will be released in a few business days. Please ensure the CVV code is accurate before retrying the transaction)',
        '800.100.195' => 'Transaction declined (UserAccount Number/ID unknown)',
        '800.100.196' => 'Transaction declined (registration error)',
        '800.100.197' => 'Transaction declined (registration cancelled externally)',
        '800.100.198' => 'Transaction declined (invalid holder)',
        '800.100.402' => 'cc/bank account holder not valid',
        '800.100.403' => 'Transaction declined (revocation of authorisation order)',
        '800.100.500' => 'Card holder has advised his bank to stop this recurring payment',
        '800.100.501' => 'Card holder has advised his bank to stop all recurring payments for this merchant',
        '800.700.100' => 'Transaction for the same session is currently being processed, please try again later.',
        '800.700.101' => 'Family name too long',
        '800.700.201' => 'Given name too long',
        '800.700.500' => 'Company name too long',
        '800.800.102' => 'Invalid street',
        '800.800.202' => 'Invalid zip',
        '800.800.302' => 'Invalid city',
    ];

    /**
     * List rejected due to communication errors response codes.
     *
     * @var array
     */
    public static $rejectedCommunication = [
        '000.400.030' => 'Transaction partially failed (please reverse manually due to failed automatic reversal)',
        '900.100.100' => 'Unexpected communication error with connector/acquirer',
        '900.100.200' => 'Error response from connector/acquirer',
        '900.100.201' => 'Error on the external gateway (e.g. on the part of the bank, acquirer,...)',
        '900.100.202' => 'Invalid transaction flow, the requested function is not applicable for the referenced transaction.',
        '900.100.203' => 'Error on the internal gateway',
        '900.100.300' => 'Timeout, uncertain result',
        '900.100.301' => 'Transaction timed out without response from connector/acquirer. It was reversed.',
        '900.100.310' => 'Transaction timed out due to internal system misconfiguration. Request to acquirer has not been sent.',
        '900.100.400' => 'Timeout at connectors/acquirer side',
        '900.100.500' => 'Timeout at connectors/acquirer side (try later)',
        '900.100.600' => 'Connector/acquirer currently down',
        '900.200.100' => 'Message Sequence Number of Connector out of sync',
        '900.300.600' => 'User session timeout',
        '900.400.100' => 'Unexpected communication error with external risk provider',
    ];

    /**
     * Result codes for rejections due to checks by external risk systems.
     *
     * @var array
     */
    public static $rejectedTransactionByRisk = [
        '100.370.100' => 'Transaction declined',
        '100.370.110' => 'Transaction must be executed for German address',
        '100.370.111' => 'System error( possible incorrect/missing input data)',
        '100.380.100' => 'Transaction declined',
        '100.380.101' => 'Transaction contains no risk management part',
        '100.380.110' => 'Transaction must be executed for German address',
        '100.380.201' => 'No risk management process type specified',
        '100.380.305' => 'No frontend information provided for asynchronous transaction',
        '100.380.306' => 'No authentication data provided in risk management transaction',
        '100.380.401' => 'User Authentication Failed',
        '100.380.501' => 'Risk management transaction timeout',
        '100.400.000' => 'Transaction declined (Wrong Address)',
        '100.400.001' => 'Transaction declined (Wrong Identification)',
        '100.400.002' => 'Transaction declined (Insufficient credibility score)',
        '100.400.005' => 'Transaction must be executed for German address',
        '100.400.007' => 'System error (possible incorrect/missing input data)',
        '100.400.020' => 'Transaction declined',
        '100.400.021' => 'Transaction declined for country',
        '100.400.030' => 'Transaction not authorized. Please check manually',
        '100.400.039' => 'Transaction declined for other error',
        '100.400.040' => 'Authorization failure',
        '100.400.041' => 'Transaction must be executed for German address',
        '100.400.042' => 'Transaction declined by SCHUFA (Insufficient credibility score)',
        '100.400.043' => 'Transaction declined because of missing obligatory parameter(s)',
        '100.400.044' => 'Transaction not authorized. Please check manually',
        '100.400.045' => 'SCHUFA result not definite. Please check manually',
        '100.400.051' => 'SCHUFA system error (possible incorrect/missing input data)',
        '100.400.060' => 'Authorization failure',
        '100.400.061' => 'Transaction declined (Insufficient credibility score)',
        '100.400.063' => 'Transaction declined because of missing obligatory parameter(s)',
        '100.400.064' => 'Transaction must be executed for Austrian, German or Swiss address',
        '100.400.065' => 'Result ambiguous. Please check manually',
        '100.400.071' => 'System error (possible incorrect/missing input data)',
        '100.400.080' => 'Authorization failure',
        '100.400.081' => 'Transaction declined',
        '100.400.083' => 'Transaction declined because of missing obligatory parameter(s)',
        '100.400.084' => 'Transaction can not be executed for given country',
        '100.400.085' => 'Result ambiguous. Please check manually',
        '100.400.086' => 'Transaction declined (Wrong Address)',
        '100.400.087' => 'Transaction declined (Wrong Identification)',
        '100.400.091' => 'System error (possible incorrect/missing input data)',
        '100.400.100' => 'Transaction declined - very bad rating',
        '100.400.120' => 'Authorization failure',
        '100.400.121' => 'Account blacklisted',
        '100.400.122' => 'Transaction must be executed for valid German account',
        '100.400.123' => 'Transaction declined because of missing obligatory parameter(s)',
        '100.400.130' => 'System error (possible incorrect/missing input data)',
        '100.400.139' => 'System error (possible incorrect/missing input data)',
        '100.400.140' => 'Transaction declined by GateKeeper',
        '100.400.141' => 'Challenge by ReD Shield',
        '100.400.142' => 'Deny by ReD Shield',
        '100.400.143' => 'Noscore by ReD Shield',
        '100.400.144' => 'ReD Shield data error',
        '100.400.145' => 'ReD Shield connection error',
        '100.400.146' => 'Line item error by ReD Shield',
        '100.400.147' => 'Payment void and Transaction denied by ReD Shield',
        '100.400.148' => 'Payment void and Transaction challenged by ReD Shield',
        '100.400.149' => 'Payment void and data error by ReD Shield',
        '100.400.150' => 'Payment void and connection error by ReD Shield',
        '100.400.151' => 'Payment void and line item error by ReD Shield',
        '100.400.152' => 'Payment void and error returned by ReD Shield',
        '100.400.241' => 'Challenged by Threat Metrix',
        '100.400.242' => 'Denied by Threat Metrix',
        '100.400.243' => 'Invalid sessionId',
        '100.400.260' => 'Authorization failure',
        '100.400.300' => 'Abort checkout process',
        '100.400.301' => 'Reenter age/birthdate',
        '100.400.302' => 'Reenter address (packstation not allowed)',
        '100.400.303' => 'Reenter address',
        '100.400.304' => 'Invalid input data',
        '100.400.305' => 'Invalid foreign address',
        '100.400.306' => 'Delivery address error',
        '100.400.307' => 'Offer only secure methods of payment',
        '100.400.308' => 'Offer only secure methods of payment; possibly abort checkout',
        '100.400.309' => 'Confirm corrected address; if not confirmed, offer secure methods of payment only',
        '100.400.310' => 'Confirm bank account data; if not confirmed, offer secure methods of payment only',
        '100.400.311' => 'Transaction declined (format error)',
        '100.400.312' => 'Transaction declined (invalid configuration data)',
        '100.400.313' => 'Currency field is invalid or missing',
        '100.400.314' => 'Amount invalid or empty',
        '100.400.315' => 'Invalid or missing email address (probably invalid syntax)',
        '100.400.316' => 'Transaction declined (card missing)',
        '100.400.317' => 'Transaction declined (invalid card)',
        '100.400.318' => 'Invalid IP number',
        '100.400.319' => 'Transaction declined by risk system',
        '100.400.320' => 'Shopping cart data invalid or missing',
        '100.400.321' => 'Payment type invalid or missing',
        '100.400.322' => 'Encryption method invalid or missing',
        '100.400.323' => 'Certificate invalid or missing',
        '100.400.324' => 'Error on the external risk system',
        '100.400.325' => 'External risk system not available',
        '100.400.326' => 'Risk bank account check unsuccessful',
        '100.400.327' => 'Risk report unsuccessful',
        '100.400.328' => 'Risk report unsuccessful (invalid data)',
        '100.400.500' => 'Waiting for external risk',
    ];

    /**
     * Result codes for rejections due to risk validation.
     *
     * @var array
     */
    public static $rejectedTransactionByRiskValidation = [
        '800.110.100' => 'Duplicate transaction',
        '800.120.100' => 'Rejected by Throttling.',
        '800.120.101' => 'Maximum number of transactions per account already exceeded',
        '800.120.102' => 'Maximum number of transactions per ip already exceeded',
        '800.120.103' => 'Maximum number of transactions per email already exceeded',
        '800.120.200' => 'Maximum total volume of transactions already exceeded',
        '800.120.201' => 'Maximum total volume of transactions per account already exceeded',
        '800.120.202' => 'Maximum total volume of transactions per ip already exceeded',
        '800.120.203' => 'Maximum total volume of transactions per email already exceeded',
        '800.120.300' => 'Chargeback rate per bin exceeded',
        '800.120.401' => 'Maximum number of transactions or total volume for configured MIDs or CIs exceeded',
        '800.130.100' => 'Transaction with same TransactionId already exists',
        '800.140.100' => 'Maximum number of registrations per mobile number exceeded',
        '800.140.101' => 'Maximum number of registrations per email address exceeded',
        '800.140.110' => 'Maximum number of registrations of mobile per credit card number exceeded',
        '800.140.111' => 'Maximum number of registrations of credit card number per mobile exceeded',
        '800.140.112' => 'Maximum number of registrations of email per credit card number exceeded',
        '800.140.113' => 'Maximum number of registrations of credit card number per email exceeded',
        '800.150.100' => 'Account Holder does not match Customer Name',
        '800.160.100' => 'Invalid payment data for configured Shopper Dispatching Type',
        '800.160.110' => 'Invalid payment data for configured Payment Dispatching Type',
        '800.160.120' => 'Invalid payment data for configured Recurring Transaction Dispatching Type',
        '800.160.130' => 'Invalid payment data for configured TicketSize Dispatching Type',
    ];

    /**
     * List rejected due to system errors response codes.
     *
     * @var array
     */
    public static $systemErrors = [
        '600.100.100' => 'Unexpected Integrator Error (Request could not be processed)',
        '800.500.100' => 'direct debit transaction declined for unknown reason',
        '800.500.110' => 'Unable to process transaction - ran out of terminalIds - please contact acquirer',
        '800.800.800' => 'The payment system is currenty unavailable, please contact support in case this happens again.',
        '800.800.801' => 'The payment system is currenty unter maintenance. Please apologize for the inconvenience this may cause. If you were not informed of this maintenance window in advance, contact your sales representative.',
        '999.999.888' => 'UNDEFINED PLATFORM DATABASE ERROR',
        '999.999.999' => 'UNDEFINED CONNECTOR/ACQUIRER ERROR',
    ];

    /**
     * Card registration errors.
     *
     * @var array
     */
    public static $accountErrors = [
        '100.100.100' => 'Request contains no creditcard, bank account number or bank name',
        '100.100.101' => 'Invalid creditcard, bank account number or bank name',
        '100.100.104' => 'Invalid unique id / root unique id',
        '100.100.200' => 'Request contains no month',
        '100.100.201' => 'Invalid month',
        '100.100.300' => 'Request contains no year',
        '100.100.301' => 'Invalid year',
        '100.100.303' => 'Card expired',
        '100.100.304' => 'Card not yet valid',
        '100.100.305' => 'Invalid expiration date format',
        '100.100.400' => 'Request contains no cc/bank account holder',
        '100.100.401' => 'cc/bank account holder too short or too long',
        '100.100.402' => 'cc/bank account holder not valid',
        '100.100.500' => 'Request contains no credit card brand',
        '100.100.501' => 'Invalid credit card brand',
        '100.100.600' => 'Empty CVV for VISA,MASTER, AMEX not allowed',
        '100.100.601' => 'Invalid CVV/brand combination',
        '100.100.650' => 'Empty CreditCardIssueNumber for MAESTRO not allowed',
        '100.100.651' => 'Invalid CreditCardIssueNumber',
        '100.100.700' => 'Invalid cc number/brand combination',
        '100.100.701' => 'Suspecting fraud, this card may not be processed',
        '100.200.100' => 'Bank account contains no or invalid country',
        '100.200.103' => 'Bank account has invalid bankcode/name account number combination',
        '100.200.104' => 'Bank account has invalid acccount number format',
        '100.200.200' => 'Bank account needs to be registered and confirmed first. Country is mandate based.',
        '100.210.101' => 'Virtual account contains no or invalid Id',
        '100.210.102' => 'Virtual account contains no or invalid brand',
        '100.211.101' => 'User account contains no or invalid Id',
        '100.211.102' => 'User account contains no or invalid brand',
        '100.211.103' => 'No password defined for user account',
        '100.211.104' => 'Password does not meet safety requirements (needs 8 digits at least and must contain letters and numbers)',
        '100.211.105' => 'Wallet id has to be a valid email address',
        '100.211.106' => 'Voucher ids have 32 digits always',
        '100.212.101' => 'Wallet account registration must not have an initial balance',
        '100.212.102' => 'Wallet account contains no or invalid brand',
        '100.212.103' => 'Wallet account payment transaction needs to reference a registration',
    ];

    /**
     * Errors due to blacklisting.
     *
     * @var array
     */
    public static $blacklistErrors = [
        '100.100.701' => 'Suspecting fraud, this card may not be processed',
        '800.200.159' => 'Account or user is blacklisted (card stolen)',
        '800.200.160' => 'Account or user is blacklisted (card blocked)',
        '800.200.165' => 'Account or user is blacklisted (card lost)',
        '800.200.202' => 'Account or user is blacklisted (account closed)',
        '800.200.208' => 'Account or user is blacklisted (account blocked)',
        '800.200.220' => 'Account or user is blacklisted (fraudulent transaction)',
        '800.300.101' => 'Account or user is blacklisted',
        '800.300.102' => 'Country blacklisted',
        '800.300.200' => 'Email is blacklisted',
        '800.300.301' => 'IP blacklisted',
        '800.300.302' => 'IP is anonymous proxy',
        '800.300.401' => 'Bin blacklisted',
        '800.300.500' => 'Transaction temporary blacklisted (too many tries invalid CVV)',
        '800.300.501' => 'Transaction temporary blacklisted (too many tries invalid expire date)',
        '800.310.200' => 'Account closed',
        '800.310.210' => 'Account not found',
        '800.310.211' => 'Account not found (BIN/issuer not participating)',
    ];

    /**
     * Result codes for rejections due to configuration validation.
     *
     * @var array
     */
    public static $rejectedValidationErrors = [
        '500.100.201' => 'Channel/Merchant is disabled (no processing possible)',
        '500.100.202' => 'Channel/Merchant is new (no processing possible yet)',
        '500.100.203' => 'Channel/Merchant is closed (no processing possible)',
        '500.100.301' => 'Merchant-Connector is disabled (no processing possible)',
        '500.100.302' => 'Merchant-Connector is new (no processing possible yet)',
        '500.100.303' => 'Merchant-Connector is closed (no processing possible)',
        '500.100.304' => 'Merchant-Connector is disabled at gateway (no processing possible)',
        '500.100.401' => 'Connector is unavailable (no processing possible)',
        '500.100.402' => 'Connector is new (no processing possible yet)',
        '500.100.403' => 'Connector is unavailable (no processing possible)',
        '500.200.101' => 'No target account configured for DD transaction',
        '600.200.100' => 'Invalid Payment Method',
        '600.200.200' => 'Unsupported Payment Method',
        '600.200.201' => 'Channel/Merchant not configured for this payment method',
        '600.200.202' => 'Channel/Merchant not configured for this payment type',
        '600.200.300' => 'Invalid Payment Type',
        '600.200.310' => 'Invalid Payment Type for given Payment Method',
        '600.200.400' => 'Unsupported Payment Type',
        '600.200.500' => 'Invalid payment data. You are not configured for this currency or sub type (country or brand)',
        '600.200.501' => 'Invalid payment data for Recurring transaction. Merchant or transaction data has wrong recurring configuration.',
        '600.200.600' => 'Invalid payment code (type or method)',
        '600.200.700' => 'Invalid payment mode (you are not configured for the requested transaction mode)',
        '600.200.800' => 'Invalid brand for given payment method and payment mode (you are not configured for the requested transaction mode)',
        '600.200.810' => 'Invalid return code provided',
        '600.300.101' => 'Merchant key not found',
        '600.300.200' => 'Merchant source IP address not whitelisted',
        '600.300.210' => 'Merchant notificationUrl not whitelisted',
        '600.300.211' => 'ShopperResultUrl not whitelisted',
        '800.121.100' => 'Channel not configured for given source type. Please contact your account manager.',
        '800.121.200' => 'Secure Query is not enabled for this entity. Please contact your account manager.',
    ];

    /**
     * Result codes for rejections due to registration validation.
     *
     * @var array
     */
    public static $rejectedRegistrationValidation = [
        '100.150.100' => 'Request contains no Account data and no registration id',
        '100.150.101' => 'Invalid length for specified registration id (must be 32 chars)',
        '100.150.200' => 'Registration does not exist',
        '100.150.201' => 'Registration is not confirmed yet',
        '100.150.202' => 'Registration is already deregistered',
        '100.150.203' => 'Registration is not valid, probably initially rejected',
        '100.150.204' => 'Account registration reference pointed to no registration transaction',
        '100.150.205' => 'Referenced registration does not contain an account',
        '100.150.300' => 'Payment only allowed with valid initial registration',
        '100.350.100' => 'Referenced session is REJECTED (no action possible).',
        '100.350.101' => 'Referenced session is CLOSED (no action possible)',
        '100.350.200' => 'Undefined session state',
        '100.350.201' => 'Referencing a registration through reference id is not applicable for this payment type',
        '100.350.301' => 'Confirmation (CF) must be registered (RG) first',
        '100.350.302' => 'Session already confirmed (CF)',
        '100.350.303' => 'Cannot deregister (DR) unregistered account and/or customer',
        '100.350.310' => 'Cannot confirm (CF) session via XML',
        '100.350.311' => 'Cannot confirm (CF) on a registration passthrough channel',
        '100.350.312' => 'Cannot do passthrough on non-internal connector',
        '100.350.313' => 'Registration of this type has to provide confirmation url',
        '100.350.314' => 'Customer could not be notified of pin to confirm registration (channel)',
        '100.350.315' => 'Customer could not be notified of pin to confirm registration (sending failed)',
        '100.350.400' => 'No or invalid PIN (email/SMS/MicroDeposit authentication) entered',
        '100.350.500' => 'Unable to obtain personal (virtual) account - most likely no more accounts available',
        '100.350.601' => 'Registration is not allowed to reference another transaction',
        '100.350.602' => 'Registration is not allowed for recurring payment migration',
    ];

    /**
     * Result codes for rejections due to reference validation.
     *
     * @var array
     */
    public static $rejectedReferenceValidation = [
        '700.100.100' => 'Reference id not existing',
        '700.100.200' => 'Non matching reference amount',
        '700.100.300' => 'Invalid amount (probably too large)',
        '700.100.400' => 'Reference payment method does not match with requested payment method',
        '700.100.500' => 'Reference payment currency does not match with requested payment currency',
        '700.100.600' => 'Reference mode does not match with requested payment mode',
        '700.100.700' => 'Reference transaction is of inappropriate type',
        '700.100.701' => 'Reference a DB transaction without explicitly providing an account. Not allowed to used referenced account.',
        '700.100.710' => 'Cross-linkage of two transaction-trees',
        '700.300.100' => 'Reference tx can not be refunded, captured or reversed (invalid type)',
        '700.300.200' => 'Reference tx was rejected',
        '700.300.300' => 'Reference tx can not be refunded, captured or reversed (already refunded, captured or reversed)',
        '700.300.400' => 'Reference tx can not be captured (cut off time reached)',
        '700.300.500' => 'Chargeback error (multiple chargebacks)',
        '700.300.600' => 'Reference tx can not be refunded or reversed (was chargebacked)',
        '700.300.700' => 'Reference tx can not be reversed (reversal not possible anymore)',
        '700.300.800' => 'Referenced tx can not be voided',
        '700.400.000' => 'Serious workflow error (call support)',
        '700.400.100' => 'Cannot capture (PA value exceeded, PA reverted or invalid workflow?)',
        '700.400.101' => 'Cannot capture (Not supported by authorization system)',
        '700.400.200' => 'Cannot refund (refund volume exceeded or tx reversed or invalid workflow?)',
        '700.400.300' => 'Cannot reverse (already refunded|reversed, invalid workflow or amount exceeded)',
        '700.400.400' => 'Cannot chargeback (already chargebacked or invalid workflow?)',
        '700.400.402' => 'chargeback can only be generated internally by the payment system',
        '700.400.410' => 'Cannot reversal chargeback (chargeback is already reversaled or invalid workflow?)',
        '700.400.420' => 'Cannot reversal chargeback (no chargeback existing or invalid workflow?)',
        '700.400.510' => 'Capture needs at least one successful transaction of type (PA)',
        '700.400.520' => 'Refund needs at least one successful transaction of type (CP or DB or RB or RC)',
        '700.400.530' => 'Reversal needs at least one successful transaction of type (CP or DB or RB or PA)',
        '700.400.540' => 'Reconceile needs at least one successful transaction of type (CP or DB or RB)',
        '700.400.550' => 'Chargeback needs at least one successful transaction of type (CP or DB or RB)',
        '700.400.560' => 'Receipt needs at least one successful transaction of type (PA or CP or DB or RB)',
        '700.400.561' => 'Receipt on a registration needs a successfull registration in state \'OPEN\'',
        '700.400.562' => 'Receipts can only be generated internally by the payment system',
        '700.400.570' => 'Cannot reference a waiting/pending transaction',
        '700.400.580' => 'Cannot find transaction',
        '700.400.700' => 'Initial and referencing channel-ids do not match',
        '700.450.001' => 'Cannot transfer money from one account to the same account',
        '700.500.001' => 'Reference session contains too many transactions',
        '700.500.002' => 'Capture or preauthorization appears too late in referenced session',
        '700.500.003' => 'Test accounts not allowed in production',
        '700.500.004' => 'Cannot refer a transaction which contains deleted customer information',
    ];

    /**
     * Result codes for rejections due to amount validation.
     *
     * @var array
     */
    public static $rejectedAmountValidation = [
        '100.550.300' => 'Request contains no amount or too low amount',
        '100.550.301' => 'Amount too large',
        '100.550.303' => 'Amount format invalid (only two decimals allowed).',
        '100.550.310' => 'Amount exceeds limit for the registered account.',
        '100.550.311' => 'Exceeding account balance',
        '100.550.312' => 'Amount is outside allowed ticket size boundaries',
        '100.550.400' => 'Request contains no currency',
        '100.550.401' => 'Invalid currency',
        '100.550.601' => 'Risk amount too large',
        '100.550.603' => 'Risk amount format invalid (only two decimals allowed)',
        '100.550.605' => 'Risk amount is smaller than amount (it must be equal or bigger then amount)',
        '100.550.701' => 'Amounts not matched',
        '100.550.702' => 'Currencies not matched',
    ];

    /**
     * Result codes for rejections due to format validation.
     *
     * @var array
     */
    public static $rejectedFormatValidation = [
        '100.300.101' => 'invalid test mode (please use LIVE or INTEGRATOR_TEST or CONNECTOR_TEST)',
        '100.300.200' => 'transaction id too long',
        '100.300.300' => 'invalid reference id',
        '100.300.400' => 'missing or invalid channel id',
        '100.300.401' => 'missing or invalid sender id',
        '100.300.402' => 'missing or invalid version',
        '100.300.501' => 'invalid response id',
        '100.300.600' => 'invalid or missing user login',
        '100.300.601' => 'invalid or missing user pwd',
        '100.300.700' => 'invalid relevance',
        '100.300.701' => 'invalid relevance for given payment type',
        '100.370.100' => 'transaction declined',
        '100.370.101' => 'responseUrl not set in Transaction/Frontend',
        '100.370.102' => 'malformed responseUrl in Transaction/Frontend',
        '100.370.110' => 'transaction must be executed for German address',
        '100.370.111' => 'system error( possible incorrect/missing input data)',
        '100.370.121' => 'no or unknown ECI Type defined in Authentication',
        '100.370.122' => 'parameter with null key provided in 3DSecure Authentication',
        '100.370.123' => 'no or unknown verification type defined in 3DSecure Authentication',
        '100.370.124' => 'unknown parameter key in 3DSecure Authentication',
        '100.370.125' => 'Invalid 3DSecure Verification_ID. Must have Base64 encoding a Length of 28 digits',
        '100.370.131' => 'no or unknown authentication type defined in Transaction/Authentication@type',
        '100.370.132' => 'no result indicator defined Transaction/Authentication/resultIndicator',
        '100.500.101' => 'payment method invalid',
        '100.500.201' => 'payment type invalid',
        '100.500.301' => 'invalid due date',
        '100.500.302' => 'invalid mandate date of signature',
        '100.600.500' => 'usage field too long',
        '100.900.500' => 'invalid recurrence mode',
        '200.100.101' => 'invalid Request Message. No valid XML. XML must be url-encoded! maybe it contains a not encoded ampersand or something similar.',
        '200.100.102' => 'invalid Request. XML load missing (XML string must be sent within parameter "load")',
        '200.100.103' => 'invalid Request Message. The request contains structural errors',
        '200.100.150' => 'transaction of multirequest not processed because of subsequent problems',
        '200.100.151' => 'multi-request is allowed with a maximum of 10 transactions only',
        '200.100.199' => 'Wrong Web Interface / URL used. Please check out the Tech Quick Start Doc Chapter 3.',
        '200.100.201' => 'invalid Request/Transaction tag (not present or [partially] empty)',
        '200.100.300' => 'invalid Request/Transaction/Payment tag (no or invalid code specified)',
        '200.100.301' => 'invalid Request/Transaction/Payment tag (not present or [partially] empty)',
        '200.100.302' => 'invalid Request/Transaction/Payment/Presentation tag (not present or [partially] empty)',
        '200.100.401' => 'invalid Request/Transaction/Account tag (not present or [partially] empty)',
        '200.100.402' => 'invalid Request/Transaction/Account(Customer, Relevance) tag (one of Account/Customer/Relevance must be present)',
        '200.100.403' => 'invalid Request/Transaction/Analysis tag (Criterions must have a name and value)',
        '200.100.404' => 'invalid Request/Transaction/Account (must not be present)',
        '200.100.501' => 'invalid or missing customer',
        '200.100.502' => 'invalid Request/Transaction/Customer/Name tag (not present or [partially] empty)',
        '200.100.503' => 'invalid Request/Transaction/Customer/Contact tag (not present or [partially] empty)',
        '200.100.504' => 'invalid Request/Transaction/Customer/Address tag (not present or [partially] empty)',
        '200.100.601' => 'invalid Request/Transaction/(ApplePay|GooglePay) tag (not present or [partially] empty)',
        '200.100.602' => 'invalid Request/Transaction/(ApplePay|GooglePay)/PaymentToken tag (not present or [partially] empty)',
        '200.100.603' => 'invalid Request/Transaction/(ApplePay|GooglePay)/PaymentToken tag (decryption error)',
        '200.200.106' => 'duplicate transaction. Please verify that the UUID is unique',
        '200.300.403' => 'Invalid HTTP method',
        '200.300.404' => 'invalid or missing parameter',
        '200.300.405' => 'Duplicate entity',
        '200.300.406' => 'Entity not found',
        '200.300.407' => 'Entity not specific enough',
        '800.900.100' => 'sender authorization failed',
        '800.900.101' => 'invalid email address (probably invalid syntax)',
        '800.900.200' => 'invalid phone number (has to start with a digit or a "+", at least 7 and max 25 chars long)',
        '800.900.201' => 'unknown channel',
        '800.900.300' => 'invalid authentication information',
        '800.900.301' => 'user authorization failed, user has no sufficient rights to process transaction',
        '800.900.302' => 'Authorization failed',
        '800.900.303' => 'No token created',
        '800.900.399' => 'Secure Registration Problem',
        '800.900.401' => 'Invalid IP number',
        '800.900.450' => 'Invalid birthdate',
    ];

    /**
     * Result codes for rejections due to risk management.
     *
     * @var array
     */
    public static $rejectedRiskManagement = [
        '100.380.101' => 'Transaction contains no risk management part',
        '100.380.201' => 'No risk management process type specified',
        '100.380.305' => 'No frontend information provided for asynchronous transaction',
        '100.380.306' => 'No authentication data provided in risk management transaction',
    ];
}
