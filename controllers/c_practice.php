<?php
class practice_controller extends base_controller {

public function p_test(){

    #querring the DB for a bio_id
    $q = "SELECT bio_id
	         FROM bios
	         WHERE user_id =".$this->user->user_id;

    $bio_id = DB::instance(DB_NAME)->select_field($q);

    echo $bio_id;

    #If the bio_id exists then redirect else allow user to create profile
    if($bio_id <= 1){
        echo "success";
    }
    else{
        # Associate this bio with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        DB::instance(DB_NAME)->insert('bios', $_POST);
    }





}










}




