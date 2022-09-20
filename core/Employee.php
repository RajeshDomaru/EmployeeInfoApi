<?php

class Employee {

    private $user_id;
    private $employee_id;
    private $employee_name;
    private $dob;
    private $mobile_number;
    private $email_address;
    private $password;
    private $profile_picture;

    public function __construct($user_id, $employee_id, $employee_name, $dob, $mobile_number, $email_address, $password, $profile_picture) {
        $this->user_id = $user_id;
        $this->employee_id = $employee_id;
        $this->employee_name = $employee_name;
        $this->dob = $dob;
        $this->mobile_number = $mobile_number;
        $this->email_address = $email_address;
        $this->password = $password;
        $this->profile_picture = $profile_picture;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getEmployee_id() {
        return $this->employee_id;
    }

    public function getEmployee_name() {
        return $this->employee_name;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getMobile_number() {
        return $this->mobile_number;
    }

    public function getEmail_address() {
        return $this->email_address;
    }

    public function getProfile_picture() {
        return $this->profile_picture;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setEmployee_id($employee_id): void {
        $this->employee_id = $employee_id;
    }

    public function setEmployee_name($employee_name): void {
        $this->employee_name = $employee_name;
    }

    public function setDob($dob): void {
        $this->dob = $dob;
    }

    public function setMobile_number($mobile_number): void {
        $this->mobile_number = $mobile_number;
    }

    public function setEmail_address($email_address): void {
        $this->email_address = $email_address;
    }

    public function setProfile_picture($profile_picture): void {
        $this->profile_picture = $profile_picture;
    }

}
