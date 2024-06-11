<?php
namespace App\Command;

use App\Model\Admin;
use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoginCommand extends Command
{
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName("app:login")
            ->setDescription("Login as a user")
            ->addArgument("email", InputArgument::REQUIRED, "Email of the customer")
            ->addArgument("password", InputArgument::REQUIRED, "Password of the user");

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument("email");
        $password = $input->getArgument("password");

        $user = $this->userService->getUser($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            $io->error("Login Failed");
            return Command::FAILURE;
        }

        if ($user instanceof Admin) {
            $io->success("Admin Logged In");

            // Provide admin options here
        }else{
            $io->success("Customer Logged In");
             // Provide customer options here
        }

        return Command::SUCCESS;
    }

}