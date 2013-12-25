<?php

class appointments_controller extends base_controller {

    public function __construct() {

        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }#EO __construct()




public function index(){

    # Setup view
    $this->template->content = View::instance('v_appointments_index');

    $this->template->title   = "Appointments";

    #get the bio
    $q = 'SELECT appointments . *
         FROM  `appointments`

         INNER JOIN users ON appointments.user_id = '.$this->user->user_id;

    $appointments = DB::instance(DB_NAME)->select_rows($q);

    $this->template->content->appointments = $appointments;

    # Render template
    echo $this->template;
}#EO edit



}