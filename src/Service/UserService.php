<?php

namespace App\Service;

class UserService
{
    public function __construct(private array $customers=[], private array $admins=[] )
    {
        
    }

    public function registerCustomer(string $name, string $email, string $password)
    {
        
    }
}