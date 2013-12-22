<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/16/13
 * Time: 11:39 PM
 */
class prices_controller extends base_controller {


    public function __construct() {

        parent::__construct();
    }

    public function index(){

        # set up the view
        $this->template->content = View::instance('v_prices');

        $this->template->title = "Prices";

        $client_files_body = Array(
            "/js/jquery.form.js",
            "/js/appointment-book.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;

    }

    public function book(){

        $data = Array();

        $data['time']= $_GET['time'];
        $data['service']= $_GET['service'];
        $data['cost']= $_GET['cost'];



        echo json_encode($data);






    }




}