<?php
Class Functions{
    public function move_file($field_name,$upload_location){
        $file_tmp_name = $_FILES[$field_name]['tmp_name'];
        $location_name = $upload_location;
        move_uploaded_file($file_tmp_name,$location_name);
    }
   
    public function getUserIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
    
}

$fun = new Functions();