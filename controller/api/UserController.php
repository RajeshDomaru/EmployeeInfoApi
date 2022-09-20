<?php

class UserController extends BaseController {

    private $userModel;

    public function __call($name, $arguments) {
        parent::__call($name, $arguments);
    }

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function findMethod() {
        $exsitingMethods = array("registration", 'login');
        $method = filter_input(INPUT_POST, METHOD);
        if (in_array($method, $exsitingMethods)) {
            $this->{$method}();
        } else {
            $this->sendOutput(ResponseEnum::STATUS_CODE_404);
        }
    }

    private function registration() {

        if (filter_input_array(INPUT_POST)) {

            if (filter_input(INPUT_POST, EMAIL_ADDRESS, FILTER_VALIDATE_EMAIL)) {

                $username = filter_input(INPUT_POST, USERNAME);
                $mobile_number = filter_input(INPUT_POST, MOBILE_NUMBER);
                $email_address = filter_input(INPUT_POST, EMAIL_ADDRESS);
                $password = filter_input(INPUT_POST, PASSWORD);
                $device_token = filter_input(INPUT_POST, DEVICE_TOKEN);
                $user = new User($username, $mobile_number, $email_address, $password, $device_token);
                $this->registrationOutput($user);
            } else {

                $this->sendOutput(ResponseEnum::STATUS_CODE_400, EMAIL_ADDRESS_INVALID);
            }
        } else {

            $this->sendOutput(ResponseEnum::STATUS_CODE_422);
        }
    }

    private function registrationOutput(User $user) {
        if ($this->userModel->isEmailAddressExist($user->getEmail_address())) {
            $this->sendOutput(ResponseEnum::STATUS_CODE_409, EMAIL_ADDRESS_ALREADY_EXSIST);
        } else if ($this->userModel->isMobileNumberExist($user->getMobile_number())) {
            $this->sendOutput(ResponseEnum::STATUS_CODE_409, MOBILE_NUMBER_ALREADY_EXSIST);
        } else {
            $this->userModel->registration($user);
            $this->loginOutput($user->getEmail_address(), $user->getPassword(), REGISTRATION_SUCCESSFULY);
        }
    }

    private function login() {

        if (filter_input_array(INPUT_POST)) {

            if (filter_input(INPUT_POST, EMAIL_ADDRESS, FILTER_VALIDATE_EMAIL) && filter_input(INPUT_POST, PASSWORD)) {

                $email_address = filter_input(INPUT_POST, EMAIL_ADDRESS);

                $password = filter_input(INPUT_POST, PASSWORD);

                $this->loginOutput($email_address, $password, LOGIN_SUCCESSFULLY);
            } else {

                $this->sendOutput(ResponseEnum::STATUS_CODE_400);
            }
        } else {

            $this->sendOutput(ResponseEnum::STATUS_CODE_422);
        }
    }

    private function loginOutput($email_address, $password, $success_message) {

        $existingUser = $this->userModel->login($email_address, $password);

        if ($existingUser === null) {   // User not exist 
            $this->sendOutput(ResponseEnum::STATUS_CODE_403, EMAIL_ADDRESS_OR_PASSWORD_IS_WRONG);
        } else {    // User exist
            $data = array(
                STATUS => $this->getStatus(STATUS_CODE_200, $success_message),
                USER => $existingUser
            );
            $this->sendOutput(ResponseEnum::STATUS_CODE_200, "", $data);
        }
    }

}
