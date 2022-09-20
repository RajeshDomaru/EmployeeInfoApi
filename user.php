<?php

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/controller/api/UserController.php";

$userController = new UserController();
$userController->findMethod();