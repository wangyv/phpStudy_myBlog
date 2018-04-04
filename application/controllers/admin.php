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
        // $offset = $this -> uri -> segment(3);
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
    public function update_article($blog_id){
        $blog_title = $this -> input -> post('title');
		$blog_content = $this -> input -> post('content');
        $blog_type_id = $this -> input -> post('type_id');
        $row = $this -> blog_model -> update_blog($blog_title, $blog_content, $blog_type_id, $blog_id);
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
    // public function delete_blog($blog_id){
    //     $row = $this -> blog_model -> delete_blog($blog_id);
    //     if($row){
    //         echo 'success';
    //         // redirect('admin/index');
    //     }else{
    //         // echo "<script>alert('删除失败！')</script>";
    //         echo 'fail';
    //     }

    // }


    public function delete_blog(){
        $blog_id = $this -> input -> post('blog_id');
        $row = $this -> blog_model -> delete_blog($blog_id);
        if($row){
            echo 'success';
            // redirect('admin/index');
        }else{
            // echo "<script>alert('删除失败！')</script>";
            echo 'fail';
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

    public function classification(){//分类管理
        $this -> load -> view('editCatalog');
    }
    public function blogcomments(){//评论管理
        $user = $this -> session -> userdata('user');
        $this -> load -> model('blog_model');
        $results = $this -> blog_model ->find_comment_by_user_id($user->user_id);
        
        //分页
        $this->load->library('pagination');

        $config['base_url'] = site_url().'admin/blogcomments';
        $config['total_rows'] = count($results);
        $config['per_page'] = 3;
        $config['next_link'] = 'NEXT';
        $config['prev_link'] = 'PREV';
        $config['num_tag_open'] = "<span>&nbsp;";
        $config['num_tag_close'] = '&nbsp;</span>';

        $this->pagination->initialize($config);

        $link = $this->pagination->create_links();
        $comment_num = $this -> blog_model -> find_comment_limit_by_user_id($user->user_id, $this->uri->segment(3), $config['per_page']);
        
        
        
        
        if($comment_num){
            $this -> load -> view('blogcomments',array(
                'comments' => $comment_num,
                'link' => $link
            ));
        }



    }
    public function inbox(){//站内留言
        $user = $this -> session -> userdata('user');
        $this -> load -> model('message_model');
        $results = $this -> message_model ->find_message_by_receiver($user->user_id);
        if(count($results)<=0){
            $results = [];
        }

        //分页
        $this->load->library('pagination');

        $config['base_url'] = site_url().'admin/inbox';
        $config['total_rows'] = count($results);
        $config['per_page'] = 3;
        $config['next_link'] = 'NEXT';
        $config['prev_link'] = 'PREV';
        $config['num_tag_open'] = "<span>&nbsp;";
        $config['num_tag_close'] = '&nbsp;</span>';

        $this->pagination->initialize($config);

        $link = $this->pagination->create_links();
        $message_num = $this -> message_model -> find_message_limit_by_receiver($user->user_id, $this->uri->segment(3), $config['per_page']);


        
        $this -> load -> view('inbox',array(
            'results' => $message_num,
            'link' => $link
        ));

        
    }
    public function profile(){//修改个人资料
        $user = $this -> session -> userdata('user');
        $this -> load -> model('user_model');
        $row = $this -> user_model -> find_by_email($user->email);
        if($row){
            $this -> load -> view('profile', array(
                'user' => $row
            ));
        }
        
    }
    public function chpwd(){
        $user = $this -> session -> userdata('user');
        $this -> load -> model('user_model');
        $row = $this -> user_model -> find_by_email($user->email);
        $this -> load -> view('chpwd',array(
            'row'=>$row
        ));
    }
    public function usersettings(){
        $user = $this -> session -> userdata('user');
        $email = $user -> email;
        $this -> load -> model('user_model');
        $row = $this -> user_model -> find_by_email($email);
        if($row){
            $this -> load -> view('usersettings',array(
                'user' => $row
            ));
        }else{
            echo 'fail';
        }
        
    }
    public function outbox(){
        $this -> load -> view('outbox');
    }
    public function remove_one_msg(){
        $message_id = $this -> input -> post('msg_id');
        $this -> load -> model('message_model');
        $row = $this -> message_model ->  del_one_msg($message_id);
        if($row){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function edit_user(){
        $email = $this -> input -> post('email');
        $username = $this -> input -> post('username');
        $gender = $this -> input -> post('gender');
        $birthday = $this -> input -> post('birthday');
        $city = $this -> input -> post('city');
        $signature = $this -> input -> post('signature');
        $this -> load -> model('user_model');
        $row = $this -> user_model -> update_by_email($email,array(
            'email'=>$email,
            'username'=>$username,
            'sex'=>$gender,
            'birthday'=>$birthday,
            'province'=>$city,
            'signature'=>$signature
        ));
        if($row){
            $user = $this -> user_model -> find_by_email($email);
            $this -> session -> set_userdata('user', $user);
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function delete_one_comment(){
        $comment_id = $this -> input -> post('comment_id');
        $this -> load -> model('blog_model');
        $row = $this -> blog_model -> delete_one_comment_by_id($comment_id);
        if($row){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function delete_this_all_comment(){
        $send_user_id = $this -> input -> post('send_user_id');
        $this -> load -> model('blog_model');
        $row = $this -> blog_model -> delete_this_all_comment_by_id($send_user_id);
        if($row){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
}
