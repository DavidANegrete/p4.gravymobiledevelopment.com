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

        # Render template
        echo $this->template;

    }





}