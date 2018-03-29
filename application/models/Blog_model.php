<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {
    public function find_blog_type_by_user($user_id){
        return $this -> db -> get_where('t_blog_type', array(
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
    public function find_by_blog_id($id){
        return $this -> db -> get_where('t_blog', array(
            'blog_id' => $id
        )) -> result();
    }
}