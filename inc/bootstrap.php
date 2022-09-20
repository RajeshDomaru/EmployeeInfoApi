<?php

define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/api/BaseController.php";

// include the core classes
require_once PROJECT_ROOT_PATH . "/core/User.php";
require_once PROJECT_ROOT_PATH . "/core/Employee.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/model/UserModel.php";
require_once PROJECT_ROOT_PATH . "/model/EmployeeInfoModel.php";

require_once PROJECT_ROOT_PATH . "/util/ApiError.php";
require_once PROJECT_ROOT_PATH . "/util/ApiMethod.php";
require_once PROJECT_ROOT_PATH . "/util/ErrorMessage.php";
require_once PROJECT_ROOT_PATH . "/util/RequestField.php";
require_once PROJECT_ROOT_PATH . "/util/StatusCode.php";
require_once PROJECT_ROOT_PATH . "/util/TagName.php";
require_once PROJECT_ROOT_PATH . "/util/enum/ResponseEnum.php";
