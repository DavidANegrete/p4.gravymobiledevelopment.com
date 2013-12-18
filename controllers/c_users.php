<?php
class users_controller extends base_controller {

public function __construct() {
	parent::__construct();
    $GLOBALS["error"] = "";

	
}

public function signup() {
	# Setup view
		$this->template->content = View::instance('v_users_signup');
		$this->template->title   = "Sign Up!";

	# Render template
		echo $this->template;
}

public function p_signup(){
	
	#Adding time stamp to store with the users	
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();

	# Encrypting the password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

	# Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

	# DB insertion
		DB::instance(DB_NAME)->insert('users', $_POST);

	 # Confirmation
		#echo 'You\'re signed up';
		Router::redirect("/users/profile");



}
##used to test cookies
public function p_test() {
echo '<pre>';
print_r($this->user);
echo '</pre>';

}

public function login() {


    # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

    # Render template
        echo $this->template;


} 

public function p_login(){
	
	# Sanitize the user entered data to keep hackers out
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);

	# Hash submitted password to complete authentication
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

	# Search the db for this email and password
    # Retrieve the token if it's available
		$q = "SELECT token 
        FROM users 
        WHERE email = '".$_POST['email']."' 
        AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

    # If we didn't find a matching token in the database, it means the login failed
        if(!$token) {

            $GLOBALS['error'] = 'Check input and try again!';

            var_dump($GLOBALS['error']);
        	# Send them back to the login page
        		Router::redirect("/users/login/", $GLOBALS['error']);

    # But if we did, login succeeded! 
        } else {

        	# setting the cookie, cookie name: token, value: token, TTL:1 year, path: '/' the entire domain.
        		//echo "Logged IN";
        		setcookie("token", $token, strtotime('+1 year'), '/');

        		Router::redirect("/users/profile");
        }
 } #EO p_login


public function logout() {

	#generate and save new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

	#Create the data array to be used with the update method
	#Only saving one thing because there is only one thing to update
		$data = Array("token" => $new_token);

	#Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

	#Delete the users token cookie by setting it to a date in the past - (logging them out)
		setcookie("token", "", strtotime('-1 year'), '/');

	#Send them back to the main index
		Router::redirect("/");
} #EO logout 

public function profile($user_name = NULL) {

	# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
        //Router::redirect('/users/login');
			Router::redirect("/");
        }

    # set up the view
        $this->template->content = View::instance('v_users_profile');
        
       $this->template->title = "Profile";


    #pass the data to the view
        $this->template->content->user_name = $user_name;

    #Display the view
        echo $this->template;
}#EO profile

public function settings($error = NULL){

    #if not logged in redirect
    if(!$this->user) {
        Router::redirect('/');
    }else{

        //Define view parameters
        $this->template->content = View::instance('v_users_settings');
        $this->template->title   = "Settings";

        //Pass error variable to the view
        $this->template->content->error = $error;


        //Display view
        echo $this->template;



    }
}#EO settings

#function to process the delete
public function p_settings_delete(){

    # Sanitize the user entered data to keep hackers out
    $_POST = DB::instance(DB_NAME)->sanitize($_POST);


    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

    $q =  "SELECT token
          FROM users
          WHERE user_id = '".$this->user->user_id."'
          AND password = '".$_POST['password']."'";


    $token = DB::instance(DB_NAME)->select_field($q);

    if(!$token){
        Router::redirect("/users/settings/?error");

    } else {

        DB::instance(DB_NAME)->delete('users', "WHERE user_id = '".$this->user->user_id."'");

        $this->template->content = View::instance('v_users_settings_confirm');
        $this->template->title   = "Deleted";

        //Display view
        echo $this->template;

    }

}
}#EOC

