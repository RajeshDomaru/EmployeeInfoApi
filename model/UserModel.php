<?php

require_once PROJECT_ROOT_PATH . "./model/Database.php";

class UserModel extends Database {

    public function registration(User $user) {
        return $this->insertOrUpdate("INSERT INTO `user_tbl`(`username`, `mobile_number`, `email_address`, `password`, `device_token`, `employee_limit`, `login_date_time`, `create_date_time`) VALUES (?, ?, ?, ?, ?, 0, now(), now())", [$user->getUsername(), $user->getMobile_number(), $user->getEmail_address(), $user->getPassword(), $user->getDevice_token()]);
    }

    public function login($email_address, $password) {
        $this->insertOrUpdate("UPDATE `user_tbl` SET `login_date_time` = now() WHERE email_address = ?", [$email_address]);
        return $this->select("SELECT * FROM `user_tbl` WHERE `email_address` = ? AND `password` = ? LIMIT 1", [$email_address, $password], false);
    }

    public function isEmailAddressExist($email_address) {
        return $this->select("SELECT * FROM user_tbl WHERE email_address = ?", [$email_address], false) > 0;
    }

    public function isMobileNumberExist($mobile_number) {
        return $this->select("SELECT * FROM user_tbl WHERE mobile_number = ?", [$mobile_number], false) > 0;
    }

    public function checkIsUserIdExisting($user_id) {
        return $this->select("SELECT * FROM user_tbl WHERE user_id = ?", [$user_id], false) > 0;
    }

    public function updateEmployeeLimit($user_id, $limit) {
        return $this->insertOrUpdate("UPDATE `user_tbl` SET `employee_limit` = ? WHERE `user_id` = ?", [$limit, $user_id]);
    }

}
