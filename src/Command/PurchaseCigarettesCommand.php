<?php

namespace App\Command;

use App\Machine\CigaretteMachine;
use App\Machine\PurchaseTransaction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        $purchaseTransaction = new PurchaseTransaction($itemCount, $amount);

        $cigaretteMachine = new CigaretteMachine();

        $purchasedItem = $cigaretteMachine->execute($purchaseTransaction);

        $output->writeln("You bought <info>{$purchasedItem->getItemQuantity()}</info> packs of cigarettes for <info>{$purchasedItem->getTotalAmount()}</info>, each for <info>{$purchasedItem->getItemPrice()}</info>. ");
        $output->writeln('Your change is:');

        $table = new Table($output);
        $table
            ->setHeaders(array('Coins', 'Count'))
            ->setRows($purchasedItem->getChange());

        $table->render();
    }
}