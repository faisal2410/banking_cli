<?php
namespace App\Model;

class User
{
    public function __construct(protected string $name, protected string $email, protected string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getName():string
    {
    return $this->name;    
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getPassword():string
    {
        return $this->password;
    }

}