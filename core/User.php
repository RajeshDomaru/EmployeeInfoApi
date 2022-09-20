<?php

class User {

    private $username;
    private $mobile_number;
    private $email_address;
    private $password;
    private $device_token;

    public function __construct($username, $mobile_number, $email_address, $password, $device_token) {
        $this->username = $username;
        $this->mobile_number = $mobile_number;
        $this->email_address = $email_address;
        $this->password = $password;
        $this->device_token = $device_token;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getMobile_number() {
        return $this->mobile_number;
    }

    public function getEmail_address() {
        return $this->email_address;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDevice_token() {
        return $this->device_token;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setUser_name($username): void {
        $this->username = $username;
    }

    public function setMobile_number($mobile_number): void {
        $this->mobile_number = $mobile_number;
    }

    public function setEmail_address($email_address): void {
        $this->email_address = $email_address;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setDevice_token($device_token): void {
        $this->device_token = $device_token;
    }

}
