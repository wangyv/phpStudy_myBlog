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
        $this -> db -> select('b.*,bt.type_name');
        $this -> db -> from('t_blog b');
        $this -> db -> join('t_blog_type bt',"bt.type_id=b.type_id");
        $this -> db -> where("bt.user_id", $user_id);
        $this -> db -> order_by('b.post_time', 'DESC');
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
        $this -> db -> join('t_user u',"u.user_id=c.send_user_id");
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
            'send_user_id' => $user_id,
            'receiver_user_id' => $user_id
        ));
        return $this -> db -> affected_rows();

    }
    public function update_blog($title, $content, $type_id, $blog_id){
        $this -> db -> where('b.blog_id', $blog_id);
        $this -> db -> update('t_blog b', array(
            'title' => $title,
            'content' => $content,
            'type_id' => $type_id
        ));
        
        return $this -> db -> affected_rows();
    }
    public function find_comment_by_user_id($user_id){
        $this -> db -> select('c.*,u.username,b.title blog_title');
        $this -> db -> from('t_comment c');
        $this -> db -> join('t_user u',"u.user_id=c.send_user_id");
        $this -> db -> join('t_blog b',"c.blog_id=b.blog_id");
        $this -> db -> where('c.receiver_user_id',$user_id);       
        return $this -> db -> get() -> result();
    }

    public function find_comment_limit_by_user_id($user_id, $offset, $page_num){
        $this -> db -> select('c.*,u.username,b.title blog_title,');
        $this -> db -> from('t_comment c');
        $this -> db -> join('t_user u',"u.user_id=c.send_user_id");
        $this -> db -> join('t_blog b',"c.blog_id=b.blog_id");
        $this -> db -> where('c.receiver_user_id',$user_id);
        $this -> db -> order_by('c.post_time', 'DESC');
        $this -> db -> limit($page_num, $offset);       
        return $this -> db -> get() -> result();
    }

    public function delete_one_comment_by_id($comment_id){
        $this -> db -> delete('t_comment', array(
            'comment_id' => $comment_id
        ));
        return $this -> db -> affected_rows();
    }
    public function delete_this_all_comment_by_id($send_user_id){
        $this -> db -> delete('t_comment', array(
            'send_user_id' => $send_user_id
        ));
        return $this -> db -> affected_rows();
    }

    public function update_blog_type_by_id($type_id,$type_name){
        $this -> db -> where('bt.type_id', $type_id);
        $this -> db -> update('t_blog_type bt', array(
            'type_name' => $type_name
        ));
        return $this -> db -> affected_rows();
    }

    public function save_blog_type($type_name,$user_id){
        $this -> db -> insert('t_blog_type', array(
            'type_name' => $type_name,
            'user_id' => $user_id
        ));
        return $this -> db -> affected_rows();

    }
    public function delete_blog_type($type_id){
        $this -> db -> delete('t_blog_type', array(
            'type_id' => $type_id
        ));
        return $this -> db -> affected_rows();

    }
}
