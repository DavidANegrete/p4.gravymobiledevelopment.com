<?php
/**
 * Created by PhpStorm.
 * User: David Negrete
 * Date: 12/13/13
 * Time: 9:49 PM
 */

class gallery_controller extends base_controller {


    public function __construct() {
        parent::__construct();
    }

    public function index(){

        # set up the view
        $this->template->content = View::instance('v_gallery_index');

        $this->template->title = "Gallery";

        # Render template
        echo $this->template;

    }


}