<?php


namespace App\Machine;

/**
 * Class PurchasedItem
 * @package App\Machine
 */
class PurchasedItem implements PurchasedItemInterface
{
    /**
     * @var int
     */
    private $itemQuantity;

    /**
     * @var float
     */
    private $itemPrice;

    /**
     * @var float
     */
    private $totalAmount;

    /**
     * @var array
     */
    private $change;

    /**
     * PurchasedItem constructor.
     * @param $itemQuantity
     * @param $itemPrice
     * @param $totalAmount
     * @param $change
     */
    public function __construct($itemQuantity, $itemPrice, $totalAmount, $change)
    {
        $this->itemQuantity = $itemQuantity;
        $this->itemPrice = $itemPrice;
        $this->totalAmount = $totalAmount;
        $this->change = $change;
    }

    /**
     * @return int
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @return float
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * @return float
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }
}