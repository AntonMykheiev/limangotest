<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    const ITEM_PRICE = 4.99;

    const COINS = array(0.02, 0.01);

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     * @throws \Exception
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $itemQuantity = $purchaseTransaction->getItemQuantity();
        $itemPrice = self::ITEM_PRICE;
        $paidAmount = $purchaseTransaction->getPaidAmount();
        $totalAmount = $itemQuantity * self::ITEM_PRICE;

        if ($paidAmount < $totalAmount) {
            throw new \Exception('Not enough money.');
        }

        $change = $paidAmount - $totalAmount;
        $change = $this->getCoins($change);

        return new PurchasedItem($itemQuantity, $itemPrice, $totalAmount, $change);
    }

    /**
     * @param $amount
     * @return array
     */
    private function getCoins($amount) {
        $amount = round($amount, 3);
        $coins = array();

        foreach (self::COINS as $coin) {
            if ($amount == 0) {
                break;
            }
            $coinsCount = $amount / $coin;

            if ($coinsCount > 1) {
                $coinsCount = floor($amount / $coin);
            }
            $coins[] = array((string)$coin,  (string)round($coinsCount, 0));

            if ($coinsCount > 0) {
                $amount -= ($coin * $coinsCount);
            }
        }

        return $coins;
    }
}