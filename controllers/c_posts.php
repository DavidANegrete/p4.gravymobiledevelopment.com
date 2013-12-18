<?php

class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }#EO add

    public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Send back to the posts
        Router::redirect("/posts/index");
    }#EO p_add

    public function index(){

        #setup view
        $this->template->content = view::instance('v_posts_index');

        #Get posts by user id
        $q = 'SELECT
            posts.content,
            posts.created,
            posts.post_id,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
            FROM posts
        INNER JOIN users_users
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;


        $posts = DB::instance(DB_NAME)->select_rows($q);

        $this->template->content->posts = $posts;

        echo $this->template;
     }#EO index

    public function users(){
        # Set up the View
        $this->template->content = View::instance("v_posts_users");
        $this->template->title   = "Users";

        # Build the query to get all the users
        $q = "SELECT *
        FROM users";

        # Execute the query to get all the users.
        # Store the result array in the variable $users
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Build the query to figure out what connections does this user already have?
        # I.e. who are they following
        $q = "SELECT *
        FROM users_users
        WHERE user_id = ".$this->user->user_id;

        # Execute this query with the select_array method
        # select_array will return our results in an array and use the "users_id_followed" field as the index.
        # This will come in handy when we get to the view
        # Store our results (an array) in the variable $connections
        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

        #get the bio
        $q = 'SELECT bios . *
         FROM  `bios`
         INNER JOIN users ON bios.user_id = '.$this->user->user_id;

        $bios = DB::instance(DB_NAME)->select_rows($q);



        # Pass data (users, connections and bios) to the view
        $this->template->content->users       = $users;
        $this->template->content->connections = $connections;
        $this->template->content->bios        = $bios;
        # Render the view
        echo $this->template;
    }#EO users
    public function follow($user_id_followed) {

        # Prepare the data array to be inserted
        $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
        );

        # Do the insert
        DB::instance(DB_NAME)->insert('users_users', $data);

        # Send them back to post
        Router::redirect("/posts/users");

    }

    public function unfollow($user_id_followed) {

        # Delete this connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

        # Send them back
        Router::redirect("/posts/users");

    }

    #method to edit the post
    public function edit(){

        #get the user_id and the post_id from the url
        $user = $_GET["user"];
        $post = $_GET["post"];

        #can edit if it is the same user
        if($user == $this->user->user_id) {

            # Setup view
            $this->template->content = View::instance('v_posts_edit');
            $this->template->title   = "Edit Post";

            $q = 'SELECT *
            FROM  `posts`
            WHERE user_id = '.$user.'
            AND post_id ='.$post.'';

            $post_db = DB::instance(DB_NAME)->select_rows($q);

            $this->template->content->post_db       = $post_db;

            echo $this->template;




        }else{
            Router::redirect("/posts/index");
        }

    }#EO edit

    public function p_edit(){
        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        #adding when it was modified and the
        $_POST['modified'] = Time::now();
        $_POST['created'] = Time::now();


        # Insert
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Send back to the posts
        Router::redirect("/posts/index");


    }#EO p_edit


}#EO Class


