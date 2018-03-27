<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function find_by_email_pwd($email, $pwd){
        return $this -> db -> get_where('t_user', array(
            'email' => $email,
            'password' => $pwd
        )) -> row();
    }
    public function save($email, $pwd, $username, $sex){
        $this -> db -> insert('t_user', array(
            'email' => $email,
            'password' => $pwd,
            'username' => $username,
            'sex' => $sex
        ));
        return $this -> db -> affected_rows();
    }
    public function find_by_email($email){
        return $this -> db -> get_where('t_user', array(
            'email' => $email
        )) -> row();
    }
}