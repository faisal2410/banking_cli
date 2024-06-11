<?php

use App\Service\UserService;
use App\Command\LoginCommand;
use App\Command\RegisterCommand;
use Symfony\Component\Console\Application;

require_once __DIR__."/vendor/autoload.php";

$app=new Application();
$userService=new UserService();

$app->add(new RegisterCommand($userService));
$app->add(new LoginCommand($userService));


$app->run();