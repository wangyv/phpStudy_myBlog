<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {
    public function find_blog_type_by_user($user_id){
        // $this -> db -> select('bt.*');
        // $this -> db -> from('t_blog_type bt');
        // $this -> db -> join('t_blog b',"bt.type_id=b.type_id");
        // $this -> db -> where("bt.user_id", $user_id);
        // return $this -> db -> get() -> result();

        return $this -> db -> get_where("t_blog_type", array(
            'user_id' => $user_id
        )) -> result();
    }
    public function save($title, $content, $type_id){
        $this -> db -> insert('t_blog', array(
            'title' => $title,
            'content' => $content,
            'type_id' => $type_id
        ));
        return $this -> db -> affected_rows();
    }
    public function find_blog_by_type_id($type_id){
        return $this -> db -> get_where('t_blog', array(
            'type_id' => $type_id
        )) -> result();
    }
    public function find_blog_type_by_type_id($type_id){
        return $this -> db -> get_where('t_blog_type', array(
            'type_id' => $type_id
        )) -> row() -> type_name;
    }
    public function find_blog_count_by_type_id($type_id){
        return $this -> db -> get_where('t_blog', array(
            'type_id' => $type_id
        )) -> result();
    }
    public function find_blog_number_by_type_id($user_id){
        $this -> db -> select('b.*');
        $this -> db -> from('t_blog b');
        $this -> db -> join('t_blog_type bt',"bt.type_id=b.type_id");
        $this -> db -> where("bt.user_id", $user_id);
        return $this -> db -> get() -> result();
    }
    public function find_blog_limit_by_type_id($user_id, $offset, $page_num){
        $this -> db -> select('b.*');
        $this -> db -> from('t_blog b');
        $this -> db -> join('t_blog_type bt',"bt.type_id=b.type_id");
        $this -> db -> where("bt.user_id", $user_id);
        $this -> db -> limit($page_num, $offset);
        return $this -> db -> get() -> result();
    }
    public function delete_blog($blog_id){
        $this -> db -> delete('t_blog', array(
            'blog_id' => $blog_id
        ));
        return $this -> db -> affected_rows();
    }
    public function find_blog_by_blog_id($blog_id){
        return $this -> db -> get_where('t_blog', array(
            'blog_id' => $blog_id
        )) -> row();
    }
    public function find_comment_by_blog_id($blog_id){
        $this -> db -> select('c.*,u.username');
        $this -> db -> from('t_comment c');
        $this -> db -> join('t_user u',"u.user_id=c.user_id");
        $this -> db -> where("c.blog_id", $blog_id);
        return $this -> db -> get() -> result();
        // return $this -> db -> get_where('t_comment', array(
        //     'blog_id' => $blog_id
        // )) -> result();
    }
    public function save_comment($blog_id, $user_id, $title){
        $this -> db -> insert('t_comment', array(
            'title' => $title,
            'blog_id' => $blog_id,
            'user_id' => $user_id
        ));
        return $this -> db -> affected_rows();

    }
}