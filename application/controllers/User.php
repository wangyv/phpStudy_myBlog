<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function login(){
        //1. 接收数据 
        $email = $this -> input -> post('email');
        $pwd = $this -> input -> post('pwd');

        //2.连数据库
        $this -> load ->model('user_model');
        $user = $this -> user_model -> find_by_email_pwd($email, $pwd);
        if($user){
            echo 'success';
            $this -> session -> set_userdata('user', $user); //存整条数据
        }else{
            echo 'fail';
        }
    }
    public function register(){
        //1.接收数据
        $email = $this -> input -> post('email');
        $name = $this -> input -> post('name');
        $pwd = $this -> input -> post('pwd');
        $pwd2 = $this -> input -> post('pwd2');
        $gender = $this -> input -> post('gender');

        //2. 判断
        //3. 连接数据库
        $this -> load -> model('user_model');
        $user = $this -> user_model -> save($email, $pwd, $name, $gender);
        if($user){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function check_email(){
        $email = $this -> input -> post('email');
        $this -> load -> model('user_model');
        $row = $this -> user_model -> find_by_email($email);
        if($row){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    public function check_old_pwd(){
        $pwd = $this -> input -> post('old_pwd');
        $new_pwd = $this -> input -> post('new_pwd');
        $user = $this -> session -> userdata('user');
        $user_pwd = $user -> password;
        $email = $user -> email;
        $this -> load -> model('user_model');
        if($pwd == $user_pwd){
            $row = $this -> user_model -> update_pwd_by_email($new_pwd, $email);
            if($row){
                $new_user = $this -> user_model -> find_by_email($email);
                $this -> session -> set_userdata('user', $new_user);
                echo 'success';
            }else{
                echo 'fail_change';
            }
        }else{
            echo 'fail_oldpwd';
        }
    }
    public function change_signature(){
        $signature = $this -> input -> post('signature');
        $user = $this -> session -> userdata('user');
        $email = $user -> email;
        $this -> load -> model('user_model');
        $row = $this -> user_model -> update_signature_by_email($email, $signature);
        if($row){
            $new_user = $this -> user_model -> find_by_email($email);
            $this -> session -> set_userdata('user', $new_user);
            echo 'success';
        }else{
            echo 'fail';
        }
    }
}