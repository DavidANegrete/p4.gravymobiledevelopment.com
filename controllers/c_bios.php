<?php



class bios_controller extends base_controller {
    public $bio_created = 1;



    public function __construct() {

        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }#EO __construct()

    public function add() {

        #querring the DB for a bio_id or redirecting
        $q = "SELECT bio_id
	         FROM bios
	         WHERE user_id =".$this->user->user_id;


        $bio_id = DB::instance(DB_NAME)->select_field($q);

        #if bio_id exists redirect
        if($bio_id >= 1){

            Router::redirect("/bios/index");


        #Set the view up
        } else {
            # Setup view
            $this->template->content = View::instance('v_bios_add');
            $this->template->title   = "Bio";

            # Render template
            echo $this->template;
        }




    }#EO add

    public function p_add() {

            # Associate this bio with this user
            $_POST['user_id']  = $this->user->user_id;

            # Unix timestamp of when this post was created / modified
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

            # Insert
            DB::instance(DB_NAME)->insert('bios', $_POST);
            Router::redirect("/bios/index");

     }#EO p_add

    public function index(){

        # Setup view
        $this->template->content = View::instance('v_bios_index');

        $this->template->title   = "Bio";

        #get the bio
        $q = 'SELECT bios . *
         FROM  `bios`
         INNER JOIN users ON bios.user_id = '.$this->user->user_id;

        $bios = DB::instance(DB_NAME)->select_rows($q);

        $this->template->content->bios = $bios;

        # Render template
        echo $this->template;
    }#EO edit

    public function edit(){
        #if not logged in redirect
        if(!$this->user) {
            Router::redirect('/');
        }else{

            //Define view parameters
            $this->template->content = View::instance('v_bios_edit');
            $this->template->title   = "Edit Bio";
            //Display view
            echo $this->template;
        }
    }#EO edit


   public function p_edit(){

       # Associate this bio with this user
       $_POST['user_id']  = $this->user->user_id;

       # Unix timestamp of when this post was  modified
       $_POST['modified'] = Time::now();

       DB::instance(DB_NAME)->update("bios", $_POST, "WHERE user_id =". $this->user->user_id);

       Router::redirect("/bios/index");

   }
























}