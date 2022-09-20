<?php

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/controller/api/EmployeeController.php";

$employeeController = new EmployeeController();
$employeeController->findMethod();
