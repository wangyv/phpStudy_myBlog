<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function index()
	{
        $this->load->view('index_logined');
	}
	public function adminindex()
	{
		$this->load->view('adminindex');
    }
    public function new_blog()
	{
        $user = $this -> session -> userdata('user');
        if($user){
            $this -> load -> model('blog_model');
            $types = $this -> blog_model -> find_blog_type_by_user($user -> user_id);
            $this-> load -> view('new_blog',array(
                'blog_types' => $types
            ));
        }
    }
    public function insert_article()
	{
		$blog_title = $this -> input -> post('title');
		$blog_content = $this -> input -> post('content');
        $blog_type_id = $this -> input -> post('type_id');
        $this -> load -> model('blog_model');
        $row = $this -> blog_model -> save($blog_title, $blog_content, $blog_type_id);
        if($row){
            $this -> load -> view('blog_management');
        }else{
            echo "<script>alert('添加博客失败！')</script>";
        }

        
    }
    public function blog_manage()
    {
        $this -> load -> view('blog_management');
    }
    public function select(){
        $this -> load -> model('blog_model');
        $result = $this -> blog_model -> find_by_blog_id('1');
    }
}
