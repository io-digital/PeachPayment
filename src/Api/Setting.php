<?php

namespace IoDigital\PeachPayment\Api;

use Illuminate\Support\Facades\Config;

/**
 * Class Setting
 *
 * Allow users of the package to easily
 * inject settings to the API.
 *
 * @package IoDigital\PeachPayment\Api
 */
class Setting
{
    protected $user;
    protected $password;
    protected $authorisationHeader;
    protected $entityIdOnceOff;
    protected $entityIdOnceRecurring;
    protected $testMode;
    protected $notificationUrl;
    protected $clientVersion;
    protected $apiUri;
    protected $apiUriVersion;
    protected $skip3dsForStoredCards;

    public function __construct()
    {
        $this->user = Config::get('peachpayment.user');
        $this->password = Config::get('peachpayment.password');
        $this->authorisationHeader = Config::get('peachpayment.authorisation_header');
        $this->entityIdOnceOff = Config::get('peachpayment.entity_id_once_off');
        $this->entityIdOnceRecurring = Config::get('peachpayment.entity_id_once_recurring');
        $this->testMode = Config::get('peachpayment.test_mode');
        $this->notificationUrl = Config::get('peachpayment.notification_url');
        $this->clientVersion = Config::get('peachpayment.client_version');
        $this->apiUri = Config::get('peachpayment.api_uri');
        $this->apiUriVersion = Config::get('peachpayment.api_uri_version');
        $this->skip3dsForStoredCards = Config::get('peachpayment.skip_3ds_for_stored_cards');
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return Setting
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return Setting
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorisationHeader()
    {
        return $this->authorisationHeader;
    }

    /**
     * @param mixed $authorisationHeader
     *
     * @return Setting
     */
    public function setAuthorisationHeader($authorisationHeader)
    {
        $this->authorisationHeader = $authorisationHeader;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntityIdOnceOff()
    {
        return $this->entityIdOnceOff;
    }

    /**
     * @param mixed $entityIdOnceOff
     *
     * @return Setting
     */
    public function setEntityIdOnceOff($entityIdOnceOff)
    {
        $this->entityIdOnceOff = $entityIdOnceOff;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntityIdOnceRecurring()
    {
        return $this->entityIdOnceRecurring;
    }

    /**
     * @param mixed $entityIdOnceRecurring
     *
     * @return Setting
     */
    public function setEntityIdOnceRecurring($entityIdOnceRecurring)
    {
        $this->entityIdOnceRecurring = $entityIdOnceRecurring;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTestMode()
    {
        return $this->testMode;
    }

    /**
     * @param mixed $testMode
     *
     * @return Setting
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * @param mixed $notificationUrl
     *
     * @return Setting
     */
    public function setNotificationUrl($notificationUrl)
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * @param mixed $clientVersion
     *
     * @return Setting
     */
    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = $clientVersion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiUri()
    {
        return $this->apiUri;
    }

    /**
     * @param mixed $apiUri
     *
     * @return Setting
     */
    public function setApiUri($apiUri)
    {
        $this->apiUri = $apiUri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiUriVersion()
    {
        return $this->apiUriVersion;
    }

    /**
     * @param mixed $apiUriVersion
     *
     * @return Setting
     */
    public function setApiUriVersion($apiUriVersion)
    {
        $this->apiUriVersion = $apiUriVersion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkip3dsForStoredCards()
    {
        return $this->skip3dsForStoredCards;
    }

    /**
     * @param mixed $skip3dsForStoredCards
     *
     * @return Setting
     */
    public function setSkip3dsForStoredCards($skip3dsForStoredCards)
    {
        $this->skip3dsForStoredCards = $skip3dsForStoredCards;
        return $this;
    }
}
