<?php

namespace App\Service;

use App\Model\Admin;
use App\Model\Customer;
use App\Model\User;

class UserService
{
    public function __construct(private array $customers = [], private array $admins = [])
    {

    }

    public function registerCustomer(string $name, string $email, string $password): Customer
    {
        $customer = new Customer($name, $email, $password);
        $this->customers[] = $customer;
        return $customer;
    }

    public function addAdmin(string $name, string $email, string $password): Admin
    {
        $admin = new Admin($name, $email, $password);
        $this->admins[] = $admin;
        return $admin;

    }

    public function getUser($email): User | null
    {
        return $this->customers[$email] ?? $this->admins[$email] ?? null;
    }

    public function getCustomer($email): Customer | null
    {
        return $this->customers[$email] ?? null;
    }

    public function getAllCustomers(): array
    {
        return $this->customers;
    }

    public function getAllTransactions(): array
    {
        $transactions = [];

        foreach ($this->customers as $customer) {

            $transactions[$customer->getEmail()] = $customer->getTransactions();
        }

        return $transactions;
    }

}