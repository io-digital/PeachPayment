<?php

namespace IoDigital\PeachPayment\Api;

class CardBuilder
{
    protected $paymentBrand;
    protected $cardNumber;
    protected $cardHolder;
    protected $expiryMonth;
    protected $expiryYear;
    protected $cvv;

    /**
     * Check whether all required fields are set.
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->paymentBrand !== null
            && $this->cardNumber !== null
            && $this->cardHolder !== null
            && $this->expiryMonth !== null
            && $this->expiryYear !== null
            && $this->cvv !== null;
    }

    /**
     * @return mixed
     */
    public function getPaymentBrand()
    {
        return $this->paymentBrand;
    }

    /**
     * @param mixed $paymentBrand
     *
     * @return CardBuilder
     */
    public function setPaymentBrand($paymentBrand)
    {
        $this->paymentBrand = $paymentBrand;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cardNumber
     *
     * @return CardBuilder
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    /**
     * @param mixed $cardHolder
     *
     * @return CardBuilder
     */
    public function setCardHolder($cardHolder)
    {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @param mixed $expiryMonth
     *
     * @return CardBuilder
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * @param mixed $expiryYear
     *
     * @return CardBuilder
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param mixed $cvv
     *
     * @return CardBuilder
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }
}
