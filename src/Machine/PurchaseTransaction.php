<?php


namespace App\Machine;

/**
 * Class PurchaseTransaction
 * @package App\Machine
 */
class PurchaseTransaction implements PurchaseTransactionInterface
{
    /**
     * @var int
     */
    private $itemCount;

    /**
     * @var float
     */
    private $amount;

    /**
     * CigaretteMachine constructor.
     * @param $itemCount
     * @param $amount
     */
    public function __construct($itemCount, $amount)
    {
        $this->itemCount = $itemCount;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getItemQuantity()
    {
        return $this->itemCount;
    }

    /**
     * @return float
     */
    public function getPaidAmount()
    {
        return $this->amount;
    }
}