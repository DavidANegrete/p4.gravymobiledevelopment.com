<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/16/13
 * Time: 11:39 PM
 */


class prices_controller extends base_controller {
    public $data = Array();
    public $apptime = 0;
    public $time;
    public $date;
    public $cost;
    public $service;

    public function __construct() {

        parent::__construct();
    }

    public function index(){

        # set up the view
        $this->template->content = View::instance('v_prices');

        $this->template->title = "Prices";

        $client_files_body = Array(
            "/js/jquery.form.js",
            "/js/appointment-book.js",
            "/js/prices_p_book.js"

        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;

    }

    public function book(){

        # Set up the view
        $view = View::instance('v_prices_confirm');

        echo $view;

    }

    public function p_book(){

        # set up the view
        $this->template->content = View::instance('v_prices_p_book');

        $this->template->title = "Confirmation";

        $client_files_body = Array(
            "/js/jquery.form.js",
            "/js/appointment-book.js",
            "/js/prices_p_book.js"

        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Associate this bio with this user
        $_POST['user_id']  = $this->user->user_id;

        DB::instance(DB_NAME)->insert('appointments', $_POST);

        $this->template->content->date = $_POST['date'];
        $this->template->content->time = $_POST['time'];


        #adding variables to the view

       echo $this->template;
/*
        echo $this->template;
*/    }


}