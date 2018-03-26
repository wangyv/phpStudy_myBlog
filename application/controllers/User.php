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
}