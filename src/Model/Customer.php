<?php
namespace App\Model;

class Customer extends User
{
    public function __construct(string $name, string $email, string $password, private float $balance = 0, private array $transactions = [])
    {
        parent::__construct($name, $email, $password);
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function deposit(float $amount): bool
    {
        $this->balance += $amount;
        $this->transactions[] = ["type" => "deposit", "amount" => $amount];
        return true;
    }

    public function withdraw($amount): bool
    {

        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->transactions[] = ["type" => "withdraw", "amount" => $amount];
            return true;
        }
        return false;
    }

    public function addTransaction($type, $amount):void
    {
        $this->transactions[]=["type"=>$type, "amount"=>$amount];
    }

    public function getTransactions():array
    {
        return $this->transactions;
    }

}