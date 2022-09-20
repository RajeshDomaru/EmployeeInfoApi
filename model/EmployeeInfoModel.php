<?php

require_once PROJECT_ROOT_PATH . "./model/Database.php";

class EmployeeInfoModel extends Database {

    public function saveOrUpdate(Employee $employee, bool $isAdd) {
        if ($isAdd) {
            return $this->insertOrUpdate("INSERT INTO `employee_tbl`(`user_id`, `employee_name`, `dob`, `mobile_number`, `email_address`, `profile_picture`, `update_date_time`, `create_date_time`) VALUES (?, ?, ?, ?, ?, ?, now(), now())",
                            [$employee->getUser_id(), $employee->getEmployee_name(), $employee->getDob(), $employee->getMobile_number(), $employee->getEmail_address(), $employee->getProfile_picture()]);
        } else {
            return $this->insertOrUpdate("UPDATE `employee_tbl` SET `employee_name` = ?, `dob` = ?, `mobile_number` = ?, `email_address` = ?, `profile_picture` = ?, `update_date_time` = now() WHERE `employee_id` = ?",
                            [$employee->getEmployee_name(), $employee->getDob(), $employee->getMobile_number(), $employee->getEmail_address(), $employee->getProfile_picture()], $employee->getEmployee_id());
        }
    }

    public function delete($employee_id) {
        return $this->select("DELETE FROM `employee_tbl` WHERE employee_id = ?", [$employee_id], false);
    }

    public function getEmployees($user_id, $limit) {
        return $this->select("SELECT * FROM employee_tbl WHERE `user_id` = ? ORDER BY `update_date_time` DESC LIMIT ?, 15", [$user_id, $limit]);
    }
    
    public function checkIsEmployeeIdExisting(int $employee_id) {
        return $this->select("SELECT * FROM employee_tbl WHERE employee_id = ?", [$employee_id], false) > 0;
    }

}
