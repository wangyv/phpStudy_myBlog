<?php
$user = $this -> session -> userdata('user');
if(!$user){
    redirect('welcome/index');
}
?>