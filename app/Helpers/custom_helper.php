<?php
if(!function_exists("is_login")){
    function is_login(){
        $session = \Config\Services::session();
        $UserModel = new App\Models\UserModel();
        $user = $UserModel->get_user_by("email",$session->get('user_email'));
        if($session->get('user_email') && $user){
            return true;
        }
        return false;
    }
}
if(!function_exists("format_rupiah")){
    function format_rupiah($amount=0){
       $total = number_format($amount,0,",",".");
       return $total;
    }
}