<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {
    public function find_message_by_receiver($user_id){
        $this -> db -> select('m.*,u.username');
        $this -> db -> from('t_message m');
        $this -> db -> join('t_user u', 'u.user_id=m.sender');
        $this -> db -> where('m.receiver', $user_id);
        return $this -> db -> get() -> result();

    }

}