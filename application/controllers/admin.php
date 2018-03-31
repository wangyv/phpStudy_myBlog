<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this -> load -> model('blog_model');
    }

    public function index()
	{
        $user = $this -> session -> userdata('user');
        $user_id = $user -> user_id;
        $types = $this -> blog_model -> find_blog_type_by_user($user_id);
        // $arr = array();
        // $count = 0;
        $blogs = $this -> blog_model -> find_blog_number_by_type_id($user_id);//总博客数


        //分页
        $this->load->library('pagination');

        $config['base_url'] = site_url().'admin/index';
        $config['total_rows'] = count($blogs);
        $config['per_page'] = 3;
        $config['next_link'] = 'NEXT';
        $config['prev_link'] = 'PREV';
        $config['num_tag_open'] = "<span>&nbsp;";
        $config['num_tag_close'] = '&nbsp;</span>';

        $this->pagination->initialize($config);

        $link = $this->pagination->create_links();

        $blog_num = $this -> blog_model -> find_blog_limit_by_type_id($user_id, $this->uri->segment(3), $config['per_page']);
        // var_dump($blogs);
        // die();
        foreach($types as $type){
            $type_id = $type -> type_id;
            // //获取博客列表
            // $blogs = $this -> blog_model -> find_blog_by_type_id($type_id);
            // if($blogs){
            //     foreach($blogs as $blog){
            //         $blog_type = $this -> blog_model -> find_blog_type_by_type_id($blog -> type_id);
            //         $blog->type_id = $blog_type;
            //         $arr[$count] = $blog;
            //         $count++;
            //     }
            // }

            //获取博客类型及数量
            $arrs = $this -> blog_model -> find_blog_count_by_type_id($type_id);
            $type -> num = count($arrs);
        }

        
        $this->load->view('index_logined',array(
            'blogs' => $blog_num,
            'types' => $types,
            'link' => $link
        ));
	}
	public function adminindex()
	{
		$this->load->view('adminindex');
    }
    public function new_blog()
	{
        $user = $this -> session -> userdata('user');
        if($user){
            $types = $this -> blog_model -> find_blog_type_by_user($user -> user_id);
            $this-> load -> view('new_blog',array(
                'blog_types' => $types
            ));
        }
        
    }
    public function change_blog()
	{
        $blog = $this -> input -> get('blog_id');
        $user = $this -> session -> userdata('user');
        if($blog && $user){
            $row = $this -> blog_model ->find_blog_by_blog_id($blog);
            $types = $this -> blog_model -> find_blog_type_by_user($user -> user_id);
            if($row && $types){
                $this-> load -> view('change_blog',array(
                    'blog' => $row,
                    'blog_types' => $types
                ));  
            }
        }
        
    }
    public function insert_article()
	{
		$blog_title = $this -> input -> post('title');
		$blog_content = $this -> input -> post('content');
        $blog_type_id = $this -> input -> post('type_id');
        $row = $this -> blog_model -> save($blog_title, $blog_content, $blog_type_id);
        if($row){
            // echo 'success';
            redirect('admin/index');
        }else{
            echo "fail";
        }

        
    }
    public function blog_manage()
    {
        $user = $this -> session -> userdata('user');
        $user_id = $user -> user_id;
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
    public function delete_blog($blog_id){
        $row = $this -> blog_model -> delete_blog($blog_id);
        if($row){
            redirect('admin/index');
        }else{
            echo "<script>alert('删除失败！')</script>";
        }

    }

    public function blog_detail($blog_id){
        $row = $this -> blog_model -> find_blog_by_blog_id($blog_id);
        if($row){
            $results = $this -> blog_model -> find_comment_by_blog_id($blog_id);
            if(count($results)<=0){
                $results = [];
            }
            $this -> load -> view('viewPost_comment', array(
                'blog' => $row,
                'results' => $results
            ));
            
        }
    }
    
    public function add_comment($blog_id){
        $user = $this -> session -> userdata('user');
        $user_id = $user -> user_id;
        // $blog_id = $this -> input -> get('blog_id');
        $title = $this -> input -> post('content');
        // $this -> load -> model('blog_model');
        $row = $this -> blog_model -> save_comment($blog_id,$user_id,$title);
        if($row){
            redirect("admin/blog_detail/$blog_id");
        }
    }

    public function classification(){
        $this -> load -> view('editCatalog');
    }
    public function blogcomments(){
        $this -> load -> view('blogcomments');
    }
    public function inbox(){//站内留言
        $user = $this -> session -> userdata('user');
        $this -> load -> model('message_model');
        $results = $this -> message_model ->find_message_by_receiver($user->user_id);
        if(count($results)<=0){
            $results = [];
        }
        $this -> load -> view('inbox',array(
            'results' => $results
        ));

        
    }
    public function profile(){
        $this -> load -> view('profile');
    }
    public function chpwd(){
        $this -> load -> view('chpwd');
    }
    public function usersettings(){
        $this -> load -> view('usersettings');
    }
    public function outbox(){
        $this -> load -> view('outbox');
    }
}
