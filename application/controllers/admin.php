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
            echo 'success';
        }else{
            echo "fail";
        }

        
    }
    public function blog_manage()
    {
        $user = $this -> session -> userdata('user');
        $user_id = $user -> user_id;
        $this -> load -> model('blog_model');
        $types = $this -> blog_model -> find_blog_type_by_user($user_id);
        $arr = array();
        $count = 0;
        foreach($types as $type){
            $type_id = $type -> type_id;
            $blogs = $this -> blog_model -> find_blog_by_type_id($type_id);
            if($blogs){
                foreach($blogs as $blog){
                    $arr[$count] = $blog;
                    $count++;
                }
            }
            
        }
        $this -> load -> view('blog_management',array(
            'blogs' => $arr
        ));
    }
    
}
