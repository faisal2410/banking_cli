<?php
namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterCommand extends Command
{
public function __construct(private UserService $userService)
{
    parent::__construct();
}

protected function configure()

{
    $this->setName("app:register")
        ->setDescription("Register a new customer")
        ->addArgument("name",InputArgument::REQUIRED,"Name of the customer")
        ->addArgument("email",InputArgument::REQUIRED,"Email of the customer")
        ->addArgument("password",InputArgument::REQUIRED,"Password of the customer");
        

}

protected function execute(InputInterface $input, OutputInterface $output): int
{
    $io=new SymfonyStyle($input, $output);

    $name=$input->getArgument("name");
    $email=$input->getArgument("email");
    $password=$input->getArgument("password");


    if($this->userService->getUser($email)){
        $io->error("User with this email already exists");
        return Command::FAILURE;
    }

    $this->userService->registerCustomer($name, $email, $password);
    $io->success("Customer Registered Successfully");
    return Command::SUCCESS;
}

}