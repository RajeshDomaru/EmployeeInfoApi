<?php

class EmployeeController extends BaseController {

    private $userModel;
    private $employeeInfoModel;

    public function __call($name, $arguments) {
        parent::__call($name, $arguments);
    }

    public function __construct() {
        $this->userModel = new UserModel();
        $this->employeeInfoModel = new EmployeeInfoModel();
    }

    public function findMethod() {
        $exsitingMethods = array("saveOrUpdate");
        $method = filter_input(INPUT_POST, METHOD);
        if (in_array($method, $exsitingMethods)) {
            $this->{$method}();
        } else {
            $this->sendOutput(ResponseEnum::STATUS_CODE_404);
        }
    }

    private function saveOrUpdate() {

        if (filter_input_array(INPUT_POST)) {

            if (filter_input(INPUT_POST, EMAIL_ADDRESS, FILTER_VALIDATE_EMAIL)) {

                $user_id = filter_input(INPUT_POST, USER_ID);
                $employee_id = filter_input(INPUT_POST, EMPLOYEE_ID);
                $employee_name = filter_input(INPUT_POST, EMPLOYEE_NAME);
                $dob = filter_input(INPUT_POST, DOB);
                $mobile_number = filter_input(INPUT_POST, MOBILE_NUMBER);
                $email_address = filter_input(INPUT_POST, EMAIL_ADDRESS);
                $password = filter_input(INPUT_POST, PASSWORD);
                $profile_picture = filter_input(INPUT_POST, PROFILE_PICTURE);

                $employee = new Employee($user_id, $employee_id, $employee_name, $dob, $mobile_number, $email_address, $password, $profile_picture);
                $this->saveOrUpdateOutput($employee);
            } else {

                $this->sendOutput(ResponseEnum::STATUS_CODE_400, EMAIL_ADDRESS_INVALID);
            }
        } else {

            $this->sendOutput(ResponseEnum::STATUS_CODE_422);
        }
    }

    private function saveOrUpdateOutput(Employee $employee) {
        if ($this->userModel->checkIsUserIdExisting($employee->getUser_id())) {
            if ($this->userModel->checkIsEmployeeIdExisting($employee->getUser_id())) {
                $this->employeeInfoModel->saveOrUpdate($employee);
                $data = array(
                    STATUS => $this->getStatus(STATUS_CODE_200, EMPLOYEE_DETAILS_SAVED_SUCCESSFULY)
                );
                $this->sendOutput(ResponseEnum::STATUS_CODE_200, "", $data);
            } else {
                $this->sendOutput(ResponseEnum::STATUS_CODE_400, INVALID_EMPLOYEE_ID);
            }
        } else {
            $this->sendOutput(ResponseEnum::STATUS_CODE_400, INVALID_USER_ID);
        }
    }

}
