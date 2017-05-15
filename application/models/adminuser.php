<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/3/2017
 * Time: 11:45 PM
 */
class adminuser extends MY_Model {

    // Constructor
    public function __construct()
    {
        parent::__construct('adminuser', 'id');
    }

    public function getPassword($username)
    {
        foreach ($this->all() as $record) {
            if($record->username == $username) {
                return $record->password;
            }
        }
        return null;
    }

    public function insert($username,$password) {
        $this->db->add($username,$password);
    }
    // use hash code for password
}